<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
$tab = "circulation";
$nav = "view";
$helpPage = "memberView";
$focus_form_name = "barcodesearch";
$focus_form_field = "barcodeNmbr";

require_once("../functions/inputFuncs.php");
require_once("../functions/formatFuncs.php");
require_once("../shared/logincheck.php");
require_once("../classes/Member.php");
require_once("../classes/MemberQuery.php");
require_once("../classes/BiblioSearch.php");
require_once("../classes/BiblioSearchQuery.php");
require_once("../classes/BiblioHold.php");
require_once("../classes/BiblioHoldQuery.php");
require_once("../classes/MemberAccountQuery.php");
require_once("../classes/DmQuery.php");
require_once("../shared/get_form_vars.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if (count($_GET) == 0) {
    header("Location: ../circ/index.php");
    exit();
}

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$mbrid = $_GET["mbrid"];
if (isset($_GET["msg"])) {
	$msg = "<div class=\"red-text\">" . H( $_GET["msg"] ) . "</div>";
} else {
    $msg = "";
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm = $dmQ->getAssoc("mbr_classify_dm");
$mbrMaxFines = $dmQ->getAssoc("mbr_classify_dm", "max_fines");
$biblioStatusDm = $dmQ->getAssoc("biblio_status_dm");
$materialTypeDm = $dmQ->getAssoc("material_type_dm");
$materialImageFiles = $dmQ->getAssoc("material_type_dm", "image_file");
$memberFieldsDm = $dmQ->getAssoc("member_fields_dm");
$dmQ->close();

#****************************************************************************
#*  Search database for member
#****************************************************************************
$mbrQ = new MemberQuery();
$mbrQ->connect();
$mbr = $mbrQ->get($mbrid);
$mbrQ->close();

#****************************************************************************
#*  Check for outstanding balance due
#****************************************************************************
$acctQ = new MemberAccountQuery();
$balance = $acctQ->getBalance($mbrid);
$balMsg = "";
if ($balance > 0 && $balance >= $mbrMaxFines[$mbr->getClassification()]) {
    $balText = moneyFormat($balance, 2);
	$balMsg  = "<div class=\"red-text\">" . $loc->getText( "mbrViewBalMsg", array( "bal" => $balText ) ) . "</div>";
}

#****************************************************************************
#*  Pr�fung auf Hinweis wegen Ablauf der Mitgliedschaft vor R�ckgabedatum
#*  Derzeit abgedeckt durch Missbrauch des Fehlercodes und Markierung mit !!! davor
#****************************************************************************
$dueMsg = "";
$pgErrors = $_SESSION['pageErrors'];
if (substr($pgErrors[barcodeNmbr], 0, 3) === '!!!') {
	$dueMsg = "<div class=\"red-text\">" . substr( $pgErrors[ barcodeNmbr ], 3 ) . "</div>";
    unset($postVars);
    unset($pageErrors);
}

#****************************************************************************
#*  Make sure member does not have expired membership
#****************************************************************************
$overMsg = "";
if ($mbr->getMembershipEnd() != "0000-00-00") {
    if (strtotime($mbr->getMembershipEnd()) <= strtotime("now")) {
	    $overMsg = "<div class=\"red-text\">" . $loc->getText( "checkoutEndErr" ) . "</div>";
    }
}
#**************************************************************************
#*  Show member information
#**************************************************************************
require_once("../shared/header.php");
?>

<h3>
	<?php echo H( $mbr->getLastName() ); ?>, <?php echo H( $mbr->getFirstName() ); ?>
</h3>

<?php echo $balMsg ?>
<?php echo $dueMsg ?>
<?php echo $overMsg ?>
<?php echo $msg ?>

<div class="row">
    <div class="container col s12 m6">

		<?php
		#****************************************************************************
		#*  Renew MemberShip
		#****************************************************************************

		echo $loc->getText( "mbrViewRenew1" ) . "&nbsp;&nbsp;&nbsp;<a href=\"../circ/mbr_renew_mbrship.php?mbrid=$mbrid&length=1\">1</a>&nbsp;&nbsp;&nbsp;<a href=\"../circ/mbr_renew_mbrship.php?mbrid=$mbrid&length=6\">6</a>&nbsp;&nbsp;&nbsp;<a href=\"../circ/mbr_renew_mbrship.php?mbrid=$mbrid&length=12\">12</a>&nbsp;&nbsp;&nbsp;" . $loc->getText( "mbrViewRenew2" );

		?>
        <br><br>

        <!--****************************************************************************
            *  Checkout form
            **************************************************************************** -->
        <form name="barcodesearch" method="POST" action="../circ/checkout.php">
            <h5><?php echo $loc->getText( "mbrViewHead3" ); ?></h5>

            <!-- Meta form fields -->
            <input type="hidden" name="mbrid" value="<?php echo H( $mbrid ); ?>">
            <input type="hidden" name="date_from" id="date_from" value="default">

            <!-- JavaScript to show/hide due date field -->
            <script type="text/javascript">
                function showDueDate() {
                    $('date_from').attr('value', 'override');
                    $('#duedateoverride').hide();
                    $('#duedate').show();
                }

                function hideDueDate() {
                    $('date_from').attr('value', 'default');
                    $('#duedateoverride').show();
                    $('#duedate').hide();
                }
            </script>

            <!-- Barcode field -->
            <div class="input-field">
				<?php printInputText( "barcodeNmbr", 18, 18, $postVars, $pageErrors ); ?>

                <label for="barcodeNmbr">
					<?php echo $loc->getText( "mbrViewBarcode" ); ?>
                </label>
            </div>

            <!-- Due date field -->
            <div id="duedate" class="row" style="display: none;">
                <div class="input-field col s10">
					<?php
					if ( isset( $_SESSION['due_date_override'] ) && ! isset( $postVars['dueDate'] ) ) {
						$postVars['dueDate'] = $_SESSION['due_date_override'];
					}
					printInputText( "dueDate", 18, 18, $postVars, $pageErrors );
					?>
                    <label for="dueDate">
						<?php echo $loc->getText( "Due Date:" ); ?>
                    </label>
                </div>

                <!-- Break button -->
                <button onclick="hideDueDate()" class="waves-effect waves-light btn-large red col s2">
                    <i class="material-icons center">cancel</i> <!--<?php echo $loc->getText( "Cancel" ); ?>-->
                </button>
            </div>


            <!-- Action buttons: search and check out -->
            <div class="row">
                <div class="container col s6">
                    <a href="javascript:popSecondaryLarge('../opac/index.php?lookup=Y')"
                       class="waves-effect waves-light btn col s12">
                        <i class="material-icons left">search</i> <?php echo $loc->getText( "indexSearch" ); ?>
                    </a>
                </div>

                <div class="container col s6">
                    <button type="submit" class="waves-effect waves-light btn green col s12">
                        <i class="material-icons left">check</i> <?php echo $loc->getText( "mbrViewCheckOut" ); ?>
                    </button>
                </div>
            </div>

            <!-- Show due date field button -->
            <div class="row">
                <div class="container col s12">
                    <a id="duedateoverride" href="#" onclick="showDueDate();"
                       class="waves-effect waves-light btn orange col s12">
                        <i class="material-icons left">edit</i> <?php echo $loc->getText( "Override Due Date" ); ?>
                    </a>
                </div>
            </div>


			<?php if ( isset( $_SESSION['postVars']['date_from'] ) && $_SESSION['postVars']['date_from'] == 'override' ) { ?>
                <script type="text/javascript">showDueDate();</script>
			<?php } ?>
        </form>


        <!--------------------------------------------->
        <!-- END OF CHECKOUT FORM --------------------->
        <!--------------------------------------------->

        <!--****************************************************************************
            *  Hold form
            **************************************************************************** -->
        <form name="holdForm" method="POST" action="../circ/place_hold.php">

            <h5><?php echo $loc->getText( "mbrViewHead5" ); ?></h5>

            <div class="input-field">
				<?php printInputText( "holdBarcodeNmbr", 18, 18, $postVars, $pageErrors ); ?>
                <label for="holdBarcodeNmbr">
					<?php echo $loc->getText( "mbrViewBarcode" ); ?>
                </label>
            </div>

            <input type="hidden" name="mbrid" value="<?php echo H( $mbrid ); ?>">
            <input type="hidden" name="classification" value="<?php echo H( $mbr->getClassification() ); ?>">

            <div class="row">
                <div class="container col s6">
                    <a href="javascript:popSecondaryLarge('../opac/index.php?lookup=Y')"
                       class="waves-effect waves-light btn col s12">
                        <i class="material-icons left">search</i> <?php echo $loc->getText( "indexSearch" ); ?>
                    </a>
                </div>
                <div class="container col s6">
                    <button type="submit" class="waves-effect waves-light btn green col s12">
                        <i class="material-icons left">check</i> <?php echo $loc->getText( "mbrViewPlaceHold" ); ?>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="container col s12 m6">
        <h5><?php echo $loc->getText( "mbrViewHead1" ); ?></h5>

        <p>
			<?php echo $loc->getText( "mbrViewName" ); ?>

			<?php echo H( $mbr->getLastName() ); ?>, <?php echo H( $mbr->getFirstName() ); ?>
        </p>

        <p>
			<?php echo $loc->getText( "mbrViewAddr" ); ?>

			<?php
			echo str_replace( "\n", "<br>", H( $mbr->getAddress() ) );
			?>
        </p>

        <p>
			<?php echo $loc->getText( "mbrViewCardNmbr" ); ?>

			<?php echo H( $mbr->getBarcodeNmbr() ); ?>
        </p>

        <p>
			<?php echo $loc->getText( "mbrViewClassify" ); ?>

			<?php echo H( $mbrClassifyDm[ $mbr->getClassification() ] ); ?>
        </p>

        <p>
			<?php echo $loc->getText( "mbrViewPhone" ); ?>

			<?php
			if ( $mbr->getHomePhone() != "" ) {
				echo $loc->getText( "mbrViewPhoneHome" ) . $mbr->getHomePhone() . " ";
			}
			if ( $mbr->getWorkPhone() != "" ) {
				echo $loc->getText( "mbrViewPhoneWork" ) . $mbr->getWorkPhone();
			}
			?>
        </p>

        <p>
			<?php echo $loc->getText( "mbrViewEmail" ); ?>

            <a href="mailto:<?php echo H( $mbr->getEmail() ); ?>"><?php echo H( $mbr->getEmail() ); ?></a>
        </p>
        <p>
			<?php print $loc->getText( "mbrViewMbrShipEnd" ); ?>

			<?php
			if ( $mbr->getMembershipEnd() == "0000-00-00" ) {
				echo $loc->getText( "mbrViewMbrShipNoEnd" );
			} else {
				echo $mbr->getMembershipEnd();
			}
			?>
        </p>


		<?php
		// Custom fields
		foreach ( $memberFieldsDm as $name => $title ) {
			if ( ( $value = $mbr->getCustom( $name ) ) ) {
				?>
                <p>
					<?php echo H( $title ); ?>:
					<?php echo H( $value ); ?>
                </p>
				<?php
			}
		}
		?>


		<?php
		#****************************************************************************
		#*  Show checkout stats
		#****************************************************************************
		$dmQ = new DmQuery();
		$dmQ->connect();
		$dms = $dmQ->getCheckoutStats( $mbr->getMbrid() );
		$dmQ->close();
		?>
		<?php echo $loc->getText( "mbrViewHead2" ); ?>
        <table class="primary">
            <tr>
                <th align="left" rowspan="2">
					<?php echo $loc->getText( "mbrViewStatColHdr1" ); ?>
                </th>
                <th align="left" rowspan="2">
					<?php echo $loc->getText( "mbrViewStatColHdr2" ); ?>
                </th>
                <th align="center" colspan="2">
					<?php echo $loc->getText( "mbrViewStatColHdr3" ); ?>
                </th>
            </tr>
            <tr>
                <th align="left">
					<?php echo $loc->getText( "mbrViewStatColHdr4" ); ?>
                </th>
                <th align="left">
					<?php echo $loc->getText( "mbrViewStatColHdr5" ); ?>
                </th>
            </tr>
			<?php
			foreach ( $dms as $dm ) {
				?>
                <tr>
                    <td nowrap="true">
						<?php echo H( $dm->getDescription() ); ?>
                    </td>
                    <td valign="top" class="primary">
						<?php echo H( $dm->getCount() ); ?>
                    </td>
                    <td valign="top" class="primary">
						<?php echo H( $dm->getCheckoutLimit() ); ?>
                    </td>
                    <td valign="top" class="primary">
						<?php echo H( $dm->getRenewalLimit() ); ?>
                    </td>
                </tr>
				<?php
			}
			?>
        </table>
    </div>
    <div class="row">
        <!-- Checkouts -->
        <h5>
			<?php echo $loc->getText( "mbrViewHead4" ); ?>
        </h5>

        <a href="javascript:popSecondary('../circ/mbr_print_checkouts.php?mbrid=<?php echo H(addslashes(U($mbrid))); ?>')">[<?php echo $loc->getText("mbrPrintCheckouts"); ?>
            ]</a>
        <a href="../circ/mbr_renew_all.php?mbrid=<?php echo HURL($mbrid); ?>">[<?php echo $loc->getText("Renew All"); ?>
            ]</a>
        <table class="striped">
            <thead>
            <tr>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr1" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr2" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr3" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr4" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr5" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr6" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr8" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr7" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewOutHdr10" ); ?>
                </th>
            </tr>
            </thead>

			<?php
			#****************************************************************************
			#*  Search database for BiblioStatus data
			#****************************************************************************
			$biblioQ = new BiblioSearchQuery();
			$biblioQ->connect();
			if ( $biblioQ->errorOccurred() ) {
				$biblioQ->close();
				displayErrorPage( $biblioQ );
			}
			if ( ! $biblioQ->doQuery( OBIB_STATUS_OUT, $mbrid ) ) {
				$biblioQ->close();
				displayErrorPage( $biblioQ );
			}
			if ( $biblioQ->getRowCount() == 0 ) {
				?>
                <tr>
                    <td>
						<?php echo $loc->getText( "mbrViewNoCheckouts" ); ?>
                    </td>
                </tr>
				<?php
			} else {
				while ( $biblio = $biblioQ->fetchRow() ) {
					?>
                    <tr>
                        <td>
							<?php echo H( $biblio->getStatusBeginDt() ); ?>
                        </td>
                        <td>
                            <img src="../images/<?php echo HURL( $materialImageFiles[ $biblio->getMaterialCd() ] ); ?>"
                                 alt="<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>">
							<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>
                        </td>
                        <td>
							<?php echo H( $biblio->getBarcodeNmbr() ); ?>
                        </td>
                        <td>
                            <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $biblio->getBibid() ); ?>">
								<?php echo H( $biblio->getTitle() ); ?>
                            </a>
                        </td>
                        <td>
							<?php echo H( $biblio->getAuthor() ); ?>
                        </td>
                        <td>
							<?php echo H( $biblio->getDueBackDt() ); ?>
                        </td>
                        <td>
                            <a href="../circ/checkout.php?barcodeNmbr=<?php echo HURL( $biblio->getBarcodeNmbr() ); ?>&amp;mbrid=<?php echo HURL( $mbrid ); ?>&amp;renewal">
								<?php echo $loc->getText( "Renew item" ); ?></A>
							<?php
							if ( $biblio->getRenewalCount() > 0 ) { ?>
                                (<?php echo H( $biblio->getRenewalCount() ); ?><?php echo $loc->getText( "mbrViewOutHdr9" ); ?>)
								<?php
							} ?>
                        </td>
                        <td>
							<?php echo H( $biblio->getDaysLate() ); ?>
                        </td>
                        <td>
                            <a href="../circ/shelving_cart.php?barcodeNmbr=<?php echo HURL( $biblio->getBarcodeNmbr() ); ?>"><?php echo $loc->getText( "To Shelving Cart" ); ?></A>
                        </td>
                    </tr>
					<?php
				}
			}
			$biblioQ->close();
			?>

        </table>


        <h1><?php echo $loc->getText( "mbrViewHead6" ); ?></h1>
        <table class="striped">
            <thead>
            <tr>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr1" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr2" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr3" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr4" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr5" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr6" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr7" ); ?>
                </th>
                <th>
					<?php echo $loc->getText( "mbrViewHoldHdr8" ); ?>
                </th>
            </tr>
            </thead>
			<?php
			#****************************************************************************
			#*  Search database for BiblioHold data
			#****************************************************************************
			$holdQ = new BiblioHoldQuery();
			$holdQ->connect();
			if ( $holdQ->errorOccurred() ) {
				$holdQ->close();
				displayErrorPage( $holdQ );
			}
			if ( ! $holdQ->queryByMbrid( $mbrid ) ) {
				$holdQ->close();
				displayErrorPage( $holdQ );
			}
			if ( $holdQ->getRowCount() == 0 ) {
				?>
                <tr>
                    <td class="primary" align="center" colspan="8">
						<?php echo $loc->getText( "mbrViewNoHolds" ); ?>
                    </td>
                </tr>
				<?php
			} else {
				while ( $hold = $holdQ->fetchRow() ) {
					?>
                    <tr>
                        <td>
                            <a href="../shared/hold_del_confirm.php?bibid=<?php echo HURL( $hold->getBibid() ); ?>&amp;copyid=<?php echo HURL( $hold->getCopyid() ); ?>&amp;holdid=<?php echo HURL( $hold->getHoldid() ); ?>&amp;mbrid=<?php echo HURL( $mbrid ); ?>"><?php echo $loc->getText( "mbrViewDel" ); ?></a>
                        </td>
                        <td>
							<?php echo H( $hold->getHoldBeginDt() ); ?>
                        </td>
                        <td>
                            <img src="../images/<?php echo HURL( $materialImageFiles[ $hold->getMaterialCd() ] ); ?>"
                                 width="20"
                                 height="20" border="0" align="middle"
                                 alt="<?php echo H( $materialTypeDm[ $hold->getMaterialCd() ] ); ?>">
							<?php echo H( $materialTypeDm[ $hold->getMaterialCd() ] ); ?>
                        </td>
                        <td>
							<?php echo H( $hold->getBarcodeNmbr() ); ?>
                        </td>
                        <td>
                            <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $hold->getBibid() ); ?>"><?php echo H( $hold->getTitle() ); ?></a>
                        </td>
                        <td>
							<?php echo H( $hold->getAuthor() ); ?>
                        </td>
                        <td>
							<?php echo H( $biblioStatusDm[ $hold->getStatusCd() ] ); ?>
                        </td>
                        <td>
							<?php echo H( $hold->getDueBackDt() ); ?>
                        </td>
                    </tr>
					<?php
				}
			}
			$holdQ->close();
			?>


        </table>
    </div>


	<?php require_once( "../shared/footer.php" ); ?>
