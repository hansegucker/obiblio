<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "admin";
$nav              = "staff";
$focus_form_name  = "editstaffform";
$focus_form_field = "last_name";

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

require_once( "../shared/header.php" );

#****************************************************************************
#*  Checking for query string flag to read data from database.
#****************************************************************************
if ( isset( $_GET["UID"] ) ) {
	unset( $_SESSION["postVars"] );
	unset( $_SESSION["pageErrors"] );

	$postVars["userid"] = $_GET["UID"];
	include_once( "../classes/Staff.php" );
	include_once( "../classes/StaffQuery.php" );
	include_once( "../functions/errorFuncs.php" );
	$staffQ = new StaffQuery();
	$staffQ->connect();
	if ( $staffQ->errorOccurred() ) {
		$staffQ->close();
		displayErrorPage( $staffQ );
	}
	$staffQ->execSelect( $postVars["userid"] );
	if ( $staffQ->errorOccurred() ) {
		$staffQ->close();
		displayErrorPage( $staffQ );
	}
	$staff                  = $staffQ->fetchStaff();
	$postVars["last_name"]  = $staff->getLastName();
	$postVars["first_name"] = $staff->getFirstName();
	$postVars["username"]   = $staff->getUsername();
	if ( $staff->hasCircAuth() ) {
		$postVars["circ_flg"] = "CHECKED";
	} else {
		$postVars["circ_flg"] = "";
	}
	if ( $staff->hasCircMbrAuth() ) {
		$postVars["circ_mbr_flg"] = "CHECKED";
	} else {
		$postVars["circ_mbr_flg"] = "";
	}
	if ( $staff->hasCatalogAuth() ) {
		$postVars["catalog_flg"] = "CHECKED";
	} else {
		$postVars["catalog_flg"] = "";
	}
	if ( $staff->hasAdminAuth() ) {
		$postVars["admin_flg"] = "CHECKED";
	} else {
		$postVars["admin_flg"] = "";
	}
	if ( $staff->hasReportsAuth() ) {
		$postVars["reports_flg"] = "CHECKED";
	} else {
		$postVars["reports_flg"] = "";
	}
	if ( $staff->isSuspended() ) {
		$postVars["suspended_flg"] = "CHECKED";
	} else {
		$postVars["suspended_flg"] = "";
	}
	$staffQ->close();
} else {
	require( "../shared/get_form_vars.php" );
}

?>

<form name="editstaffform" method="POST" action="../admin/staff_edit.php">
    <input type="hidden" name="userid" value="<?php echo H( $postVars["userid"] ); ?>">

    <h3><?php echo $loc->getText( "adminStaff_edit_formHeader" ); ?></h3>

    <div class="input-field">
        <label for="username">
			<?php echo $loc->getText( "adminStaff_edit_formLogin" ); ?>
        </label>
		<?php printInputText( "username", 20, 20, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="last_name">
			<?php echo $loc->getText( "adminStaff_edit_formLastname" ); ?>
        </label>
		<?php printInputText( "last_name", 30, 30, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="first_name">
			<?php echo $loc->getText( "adminStaff_edit_formFirstname" ); ?>
        </label>
		<?php printInputText( "first_name", 30, 30, $postVars, $pageErrors ); ?>
    </div>


    <p>
        <strong><?php echo $loc->getText( "adminStaff_edit_formAuth" ); ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;
        <label>
            <input type="checkbox" class="filled-in" name="circ_flg" value="CHECKED"
				<?php if ( isset( $postVars["circ_flg"] ) ) {
					echo H( $postVars["circ_flg"] );
				} ?> >
            <span><?php echo $loc->getText( "adminStaff_edit_formCirc" ); ?></span>
        </label> &nbsp;&nbsp;&nbsp;&nbsp;

        <label>
            <input type="checkbox" class="filled-in" name="circ_mbr_flg" value="CHECKED"
				<?php if ( isset( $postVars["circ_mbr_flg"] ) ) {
					echo H( $postVars["circ_mbr_flg"] );
				} ?> >
            <span><?php echo $loc->getText( "adminStaff_edit_formUpdatemember" ); ?></span>
        </label> &nbsp;&nbsp;&nbsp;&nbsp;

        <label>
            <input type="checkbox" class="filled-in" name="catalog_flg" value="CHECKED"
				<?php if ( isset( $postVars["catalog_flg"] ) ) {
					echo H( $postVars["catalog_flg"] );
				} ?> >
            <span><?php echo $loc->getText( "adminStaff_edit_formCatalog" ); ?></span>
        </label> &nbsp;&nbsp;&nbsp;&nbsp;

        <label>
            <input type="checkbox" class="filled-in" name="admin_flg" value="CHECKED"
				<?php if ( isset( $postVars["admin_flg"] ) ) {
					echo H( $postVars["admin_flg"] );
				} ?> >

            <span><?php echo $loc->getText( "adminStaff_edit_formAdmin" ); ?></span>
        </label> &nbsp;&nbsp;&nbsp;&nbsp;

        <label>
            <input type="checkbox" class="filled-in" name="reports_flg" value="CHECKED"
				<?php if ( isset( $postVars["reports_flg"] ) ) {
					echo H( $postVars["reports_flg"] );
				} ?> >
            <span><?php echo $loc->getText( "adminStaff_edit_formReports" ); ?></span>
        </label>
    </p>
    <p>
        <label>
            <input type="checkbox" class="filled-in" name="suspended_flg" value="CHECKED"
				<?php if ( isset( $postVars["suspended_flg"] ) ) {
					echo H( $postVars["suspended_flg"] );
				} ?> >
            <span><?php echo $loc->getText( "adminStaff_edit_formSuspended" ); ?></span>
        </label>
    </p>

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">save</i>
		<?php echo $loc->getText( "adminSubmit" ); ?>
    </button>
    <a href="../admin/staff_list.php" class="waves-effect waves-light btn red">
        <i class="material-icons left">cancel</i>
		<?php echo $loc->getText( "adminCancel" ); ?>
    </a>

</form>

<?php include( "../shared/footer.php" ); ?>
