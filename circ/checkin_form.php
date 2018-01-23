<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab              = "circulation";
$nav              = "checkin";
$helpPage         = "checkin";
$focus_form_name  = "barcodesearch";
$focus_form_field = "barcodeNmbr";

/*  function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  } 
  $startTm = getmicrotime();
*/

/*
  $endTm = getmicrotime();
  trigger_error ("read_settings: start=".$startTm." end=".$endTm." diff=".($endTm - $startTm),E_USER_NOTICE);
  $startTm = getmicrotime();
*/

require_once( "../functions/inputFuncs.php" );
require_once( "../functions/formatFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioSearch.php" );
require_once( "../classes/BiblioSearchQuery.php" );
require_once( "../classes/MemberAccountQuery.php" );
require_once( "../classes/MemberQuery.php" );
require_once( "../shared/get_form_vars.php" );
require_once( "../shared/header.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

/*
  $endTm = getmicrotime();
  trigger_error ("Header: start=".$startTm." end=".$endTm." diff=".($endTm - $startTm),E_USER_NOTICE);
  $startTm = getmicrotime();
*/
?>


<!--**************************************************************************
    *  Javascript to post checkin form
    ************************************************************************** -->
<script language="JavaScript" type="text/javascript">
    <!--
    function checkin(massCheckinFlg) {
        document.checkinForm.massCheckin.value = massCheckinFlg;
        document.checkinForm.submit();
    }

    -->
</script>

<?php
if ( isset( $_GET['barcode'] ) ) {
	if ( isset( $_GET['mbrid'] ) and $_GET['mbrid'] ) {
		$memberQ = new MemberQuery;
		$mbr     = $memberQ->get( $_GET['mbrid'] );
		echo '<p class="flow-text">';
		echo $loc->getText( "Checked in %barcode% for ", array(
			'barcode' => htmlspecialchars( $_GET['barcode'] ),
		) );
		echo '<a href="../circ/mbr_view.php?mbrid=' . HURL( $mbr->getMbrid() ) . '&amp;reset=Y">';
		echo $loc->getText( "%fname% %lname%", array(
			'fname' => $mbr->getFirstName(),
			'lname' => $mbr->getLastName(),
		) );
		echo '</a>.';
		echo '</p>';
		if ( isset( $_GET['late'] ) and $_GET['late'] ) {
			echo '<div class="red-text">' .
			     $loc->getText( "mbrViewOutHdr7" ) . ': ' .
			     htmlspecialchars( $_GET['late'] ) . '</div>';
		}
		$acctQ   = new MemberAccountQuery();
		$balance = $acctQ->getBalance( $mbr->getMbrid() );
		$balMsg  = "";
		if ( $balance > 0 ) {
			$balText = moneyFormat( $balance, 2 );
			$balMsg  = "<div class=\"red-text\">" .
			           $loc->getText( "mbrViewBalMsg", array( "bal" => $balText ) )
			           . "</div>";
		}
		echo $balMsg;
		/* Neu: Prüfe ob die Nutzungsgebuehr noch aktuell oder abgelaufen ist */
		if ( $mbr->getMembershipEnd() != "0000-00-00" ) {
			if ( strtotime( $mbr->getMembershipEnd() ) < strtotime( "now" ) ) {
				$pDate1  = strtotime( $mbr->getMembershipEnd() );
				$pDate2  = strtotime( "now" );
				$lDay1   = date( 'd', $pDate1 );
				$lMonth1 = date( 'm', $pDate1 );
				$lYear1  = date( 'Y', $pDate1 );
				$lDay2   = date( 'd', $pDate2 );
				$lMonth2 = date( 'm', $pDate2 );
				$lYear2  = date( 'Y', $pDate2 );

				/* Berechne Differenz der Tage */
				$lDays = $lDay2 - $lDay1;
				if ( $lDays < 0 ) {
					$lDays  += date( 't', $pDate1 );
					$lCarry = 1;
				} else {
					$lCarry = 0;
				}

				/* Berechne Differenz der Monate */
				$lMonths = $lMonth2 - $lMonth1 - $lCarry;

				if ( $lMonths < 0 ) {
					$lMonths += 12;
					$lCarry  = 1;
				} else {
					$lCarry = 0;
				}

				/* Berechne Differenz der Jahre */
				$lYears = $lYear2 - $lYear1 - $lCarry;

				$monthlate = $lMonths + 1 + 12 * $lYears;
				$overMsg   = "<div class=\"red-text\">" .
				             $loc->getText( "checkinEndErr", array( "monthlate" => $monthlate ) ) .
				             "</div>";
				if ( ( $lDays == 0 ) and ( $lMonths == 0 ) and ( $lYears == 0 ) ) {
					$overMsg = "";
				}
			}
		}
		echo $overMsg;
	} else {
		echo '<p class="flow-text">' .
		     $loc->getText( "Checked in %barcode%.", array( 'barcode' => htmlspecialchars( $_GET['barcode'] ) ) ) .
		     '</p>';
	}
}
?>

<form name="barcodesearch" method="POST" action="../circ/shelving_cart.php">
    <h5><?php echo $loc->getText( "checkinFormHdr1" ); ?></h5>

    <div class="input-field">
        <label for="barcodeNmbr"><?php echo $loc->getText( "checkinFormBarcode" ); ?></label>
		<?php printInputText( "barcodeNmbr", 18, 18, $postVars, $pageErrors ); ?>
    </div>


    <a href="javascript:popSecondaryLarge('../opac/index.php?lookup=Y')"
       class="waves-effect waves-light btn">
        <i class="material-icons left">search</i>
		<?php echo $loc->getText( "indexSearch" ); ?>
    </a>

    <button type="submit" class="waves-effect waves-light btn green">
		<?php echo $loc->getText( "checkinFormShelveButton" ); ?>
    </button>
</form>

<?php
if ( isset( $_GET["msg"] ) ) {
	echo "<div class=\"red-text\">";
	echo H( $_GET["msg"] ) . "</div>";
}
?>

<form name="checkinForm" method="POST" action="../circ/checkin.php">
    <input type="hidden" name="massCheckin" value="N">
    <!--    <a href="javascript:checkin('N')">-->
	<?php //echo $loc->getText( "checkinFormCheckinLink1" ); ?><!--</a> |-->
    <!--    <a href="javascript:checkin('Y')">-->
	<?php //echo $loc->getText( "checkinFormCheckinLink2" ); ?><!--</a><br><br>-->

    <h5><?php echo $loc->getText( "checkinFormHdr2" ); ?></h5>

    <table>
        <tr>
            <th></th>
            <th>
		        <?php echo $loc->getText( "checkinFormColHdr1" ); ?>
            </th>
            <th>
		        <?php echo $loc->getText( "checkinFormColHdr2" ); ?>
            </th>
            <th>
		        <?php echo $loc->getText( "checkinFormColHdr3" ); ?>
            </th>
            <th>
		        <?php echo $loc->getText( "checkinFormColHdr4" ); ?>
            </th>
        </tr>

		<?php
		#****************************************************************************
		#*  Search database for biblio copy data
		#****************************************************************************
		$biblioQ = new BiblioSearchQuery();
		$biblioQ->connect();
		if ( $biblioQ->errorOccurred() ) {
			$biblioQ->close();
			displayErrorPage( $biblioQ );
		}
		if ( ! $biblioQ->doQuery( OBIB_STATUS_SHELVING_CART ) ) {
			$biblioQ->close();
			displayErrorPage( $biblioQ );
		}
		if ( $biblioQ->getRowCount() == 0 ) {
			?>
            <td>
				<?php echo $loc->getText( "checkinFormEmptyCart" ); ?>
            </td>
			<?php
		} else {
			while ( $biblio = $biblioQ->fetchRow() ) {
				?>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox"
                                   name="bibid=<?php echo HURL( $biblio->getBibid() ); ?>&amp;copyid=<?php echo HURL( $biblio->getCopyid() ); ?>"
                                   value="copyid">
                            <span></span>
                        </label>
                    </td>
                    <td>
		                <?php echo H( $biblio->getStatusBeginDt() ); ?>
                    </td>
                    <td>
		                <?php echo H( $biblio->getBarcodeNmbr() ); ?>
                    </td>
                    <td>
		                <?php echo H( $biblio->getTitle() ); ?>
                    </td>
                    <td>
		                <?php echo H( $biblio->getAuthor() ); ?>
                    </td>
                </tr>
				<?php
			}
		}
		$biblioQ->close();
		?>
    </table>
    <a href="javascript:checkin('N')" class="waves-effect waves-light btn green">
        <i class="material-icons left">done</i>
		<?php echo $loc->getText( "checkinFormCheckinLink1" ); ?>
    </a>
    <a href="javascript:checkin('Y')" class="waves-effect waves-light btn green">
        <i class="material-icons left">done_all</i>
		<?php echo $loc->getText( "checkinFormCheckinLink2" ); ?>
    </a>
</form>


<?php require_once( "../shared/footer.php" );

/*
  $endTm = getmicrotime();
  trigger_error ("Footer: start=".$startTm." end=".$endTm." diff=".($endTm - $startTm),E_USER_NOTICE);
*/
?>
