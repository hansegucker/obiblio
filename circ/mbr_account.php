<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab              = "circulation";
$nav              = "account";
$focus_form_name  = "accttransform";
$focus_form_field = "transactionTypeCd";

require_once( "../functions/inputFuncs.php" );
require_once( "../functions/formatFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../shared/get_form_vars.php" );
require_once( "../classes/MemberAccountTransaction.php" );
require_once( "../classes/MemberAccountQuery.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if ( count( $_GET ) == 0 ) {
	header( "Location: ../circ/index.php" );
	exit();
}

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$mbrid = $_GET["mbrid"];
if ( isset( $_GET["msg"] ) ) {
	$msg = "<div class=\"red-text\">" . H( $_GET["msg"] ) . "</div>";
} else {
	$msg = "";
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm = $dmQ->getAssoc( "transaction_type_dm" );
$dmQ->close();

#****************************************************************************
#*  Show transaction input form
#****************************************************************************
require_once( "../shared/header.php" );
?>

<?php echo $msg ?>

<form name="accttransform" method="POST" action="../circ/mbr_transaction.php">

    <h5><?php echo $loc->getText( "mbrAccountLabel" ); ?></h5>

    <div class="input-field">
        <label for="transactionTypeCd"><?php echo $loc->getText( "mbrAccountTransTyp" ); ?></label>
		<?php printSelect( "transactionTypeCd", "transaction_type_dm", $postVars ); ?>
    </div>

    <div class="input-field">
        <label for="description"><?php echo $loc->getText( "mbrAccountDesc" ); ?></label>
		<?php printInputText( "description", 40, 128, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="amount"><?php echo $loc->getText( "mbrAccountAmount" ); ?></label>
		<?php printInputText( "amount", 12, 12, $postVars, $pageErrors ); ?>
    </div>

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">add</i>
		<?php echo $loc->getText( "circAdd" ); ?>
    </button>

    <input type="hidden" name="mbrid" value="<?php echo H( $mbrid ); ?>">
</form>

<?php
#****************************************************************************
#*  Search database for member account info
#****************************************************************************
$transQ = new MemberAccountQuery();
$transQ->connect();
if ( $transQ->errorOccurred() ) {
	$transQ->close();
	displayErrorPage( $transQ );
}
if ( ! $transQ->doQuery( $mbrid ) ) {
	$transQ->close();
	displayErrorPage( $transQ );
}

?>

<h5><?php echo $loc->getText( "mbrAccountHead1" ); ?></h5>
<table>
    <tr>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr1" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr2" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr3" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr4" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr5" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrAccountHdr6" ); ?>
        </th>
    </tr>

	<?php
	if ( $transQ->getRowCount() == 0 ) {
		?>
        <tr>
            <td>
		        <?php echo $loc->getText( "mbrAccountNoTrans" ); ?>
            </td>
        </tr>
		<?php
	} else {
		$bal = 0;
		?>


		<?php
		while ( $trans = $transQ->fetchRow() ) {
			$bal = $bal + $trans->getAmount();
			?>
            <tr>
                <td>
                    <a class="waves-effect waves-light btn red"
                       href="../circ/mbr_transaction_del_confirm.php?mbrid=<?php echo HURL( $mbrid ); ?>&amp;transid=<?php echo HURL( $trans->getTransid() ); ?>">
                        <i class="material-icons left">delete</i>
			            <?php echo $loc->getText( "mbrAccountDel" ); ?>
                    </a>
                </td>
                <td>
		            <?php echo H( $trans->getCreateDt() ); ?>
                </td>
                <td>
		            <?php echo H( $trans->getTransactionTypeDesc() ); ?>
                </td>
                <td>
		            <?php echo H( $trans->getDescription() ); ?>
                </td>
                <td>
		            <?php echo H( moneyFormat( $trans->getAmount(), 2 ) ); ?>
                </td>
                <td>
		            <?php echo H( moneyFormat( $bal, 2 ) ); ?>
                </td>
            </tr>
			<?php
		}
		?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><?php echo $loc->getText( "mbrAccountOpenBal" ); ?></td>
            <td></td>
            <td><?php echo H( moneyFormat( $bal, 2 ) ); ?></td>
        </tr>
		<?php
	}
	$transQ->close();

	?>
</table>

<?php require_once( "../shared/footer.php" ); ?>
