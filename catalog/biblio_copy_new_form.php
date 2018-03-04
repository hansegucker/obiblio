<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "cataloging";
$nav              = "newcopy";
$helpPage         = "biblioCopyEdit";
$focus_form_name  = "newCopyForm";
$focus_form_field = "barcodeNmbr";

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if ( count( $_GET ) == 0 ) {
	header( "Location: ../catalog/index.php" );
	exit();
}

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../shared/get_form_vars.php" );
require_once( '../classes/DmQuery.php' );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$bibid = $_GET["bibid"];
require_once( "../shared/header.php" );

$dmQ = new DmQuery();
$dmQ->connect();
$customFields = $dmQ->getAssoc( 'biblio_copy_fields_dm' );
$dmQ->close();
?>

<p>
	<?php echo $loc->getText( "catalogFootnote", array( "symbol" => "*" ) ); ?>
</p>

<form name="newCopyForm" method="POST" action="../catalog/biblio_copy_new.php">
    <h5><?php echo $loc->getText( "biblioCopyNewFormLabel" ); ?></h5>

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
		echo '<label for="costum_' . $name . '">' . H( $title ) . '</label>';
		printInputText( 'custom_' . $name, 40, 40, $postVars, $pageErrors );
		echo '</div>';
	}
	?>

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
</form>


<?php include( "../shared/footer.php" ); ?>
