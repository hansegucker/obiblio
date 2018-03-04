<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "cataloging";
$nav              = "editcopy";
$helpPage         = "biblioCopyEdit";
$focus_form_name  = "editCopyForm";
$focus_form_field = "barcodeNmbr";
require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioCopy.php" );
require_once( "../classes/BiblioCopyQuery.php" );
require_once( '../classes/DmQuery.php' );
require_once( "../functions/errorFuncs.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

$dmQ = new DmQuery();
$dmQ->connect();
$customFields = $dmQ->getAssoc( 'biblio_copy_fields_dm' );
$dmQ->close();

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
if ( isset( $_GET["bibid"] ) ) {
	unset( $_SESSION["postVars"] );
	unset( $_SESSION["pageErrors"] );
	#****************************************************************************
	#*  Retrieving get var
	#****************************************************************************
	$bibid  = $_GET["bibid"];
	$copyid = $_GET["copyid"];

	#****************************************************************************
	#*  Read copy information
	#****************************************************************************
	$copyQ = new BiblioCopyQuery();
	$copyQ->connect();
	if ( $copyQ->errorOccurred() ) {
		$copyQ->close();
		displayErrorPage( $copyQ );
	}
	if ( ! $copy = $copyQ->doQuery( $bibid, $copyid ) ) {
		$copyQ->close();
		displayErrorPage( $copyQ );
	}
	$postVars["bibid"]       = $bibid;
	$postVars["copyid"]      = $copyid;
	$postVars["barcodeNmbr"] = $copy->getBarcodeNmbr();
	$postVars["copyDesc"]    = $copy->getCopyDesc();
	$postVars["statusCd"]    = $copy->getStatusCd();
	foreach ( $customFields as $name => $title ) {
		$postVars[ "custom_" . $name ] = $copy->getCustom( $name );
	}
} else {
	#**************************************************************************
	#*  load up post vars
	#**************************************************************************
	require( "../shared/get_form_vars.php" );
	$bibid  = $postVars["bibid"];
	$copyid = $postVars["copyid"];
}

# Transitions to and from these status codes aren't allowed on this form.
$disallowed = array(
	OBIB_STATUS_SHELVING_CART,
	OBIB_STATUS_OUT,
	OBIB_STATUS_ON_HOLD,
);

require_once( "../shared/header.php" );
?>

<p>
	<?php echo $loc->getText( "catalogFootnote", array( "symbol" => "*" ) ); ?>
</p>

<form name="editCopyForm" method="POST" action="../catalog/biblio_copy_edit.php">
    <h5>
		<?php echo $loc->getText( "biblioCopyEditFormLabel" ); ?>
    </h5>

    <div class="input-field">
        <label for="barcodeNmbr">
            <sup>*</sup> <?php echo $loc->getText( "biblioCopyNewBarcode" ); ?>
        </label>

		<?php printInputText( "barcodeNmbr", 20, 20, $postVars, $pageErrors ); ?>
    </div>

    <p>
        <label>
            <input type="checkbox" name="autobarco" class="filled-in">
            <span><?php echo $loc->getText( "biblioCopyNewAuto" ); ?></span>
        </label>

        &nbsp;&nbsp;&nbsp;&nbsp;

        <label>
            <input type="checkbox" name="validBarco" value="CHECKED" checked="checked" class="filled-in">
            <span><?php echo $loc->getText( "biblioCopyNewValidBarco" ); ?></span>
        </label>
    </p>

    <div class="input-field">
        <label for="copyDesc">
			<?php echo $loc->getText( "biblioCopyNewDesc" ); ?>
        </label>

		<?php printInputText( "copyDesc", 40, 40, $postVars, $pageErrors ); ?>
    </div>

	<?php
	foreach ( $customFields as $name => $title ) {
		echo '<div class="input-field">';
		echo '<label for="custom_' . $name . '">' . H( $title ) . '</label>';
		printInputText( 'custom_' . $name, 40, 40, $postVars, $pageErrors );
		echo '</div>';
	}
	?>

    <div class="input-field">

		<?php echo $loc->getText( "biblioCopyEditFormStatus" ); ?>


		<?php
		#**************************************************************************
		#*  only show status codes for valid transitions
		#**************************************************************************
		$dmQ = new DmQuery();
		$dmQ->connect();
		$dms = $dmQ->get( "biblio_status_dm" );
		$dmQ->close();
		echo "<select name=\"statusCd\"";
		if ( in_array( $postVars["statusCd"], $disallowed ) ) {
			echo " disabled";
		}
		echo ">";
		foreach ( $dms as $dm ) {
			$cd = $dm->getCode();
			# We don't normally show transitions to disallowed states, but
			# we do want to show the correct status, if it's one of those.
			if ( in_array( $cd, $disallowed ) && $cd != $postVars["statusCd"] ) {
				continue;
			}
			echo "<option value=\"" . H( $dm->getCode() ) . "\"";
			if ( ( $postVars["statusCd"] == "" ) && ( $dm->getDefaultFlg() == 'Y' ) ) {
				echo " selected";
			} elseif ( $postVars["statusCd"] == $dm->getCode() ) {
				echo " selected";
			}
			echo ">" . H( $dm->getDescription() ) . "</option>\n";
		}
		echo "</select>";
		?>
    </div>


    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">save</i>
		<?php echo $loc->getText( "catalogSubmit" ); ?>
    </button>

    <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>"
       class="waves-effect waves-light btn red">
        <i class="material-icons left">cancel</i>
		<?php echo $loc->getText( "catalogCancel" ); ?>
    </a>

    <input type="hidden" name="bibid" value="<?php echo H( $bibid ); ?>">
    <input type="hidden" name="copyid" value="<?php echo H( $copyid ); ?>">
</form>


<?php include( "../shared/footer.php" ); ?>
