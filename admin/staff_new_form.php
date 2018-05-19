<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "admin";
$nav              = "staff";
$focus_form_name  = "newstaffform";
$focus_form_field = "last_name";

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../shared/get_form_vars.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

require_once( "../shared/header.php" );

?>

<form name="newstaffform" method="POST" action="../admin/staff_new.php">
    <h3>
		<?php echo $loc->getText( "adminStaff_new_form_Header" ); ?>
    </h3>

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


    <div class="input-field">
        <label for="pwd">
			<?php echo $loc->getText( "adminStaff_new_form_Password" ); ?>
        </label>

        <input type="password" name="pwd" id="pwd" size="20" maxlength="20"
               value="<?php if ( isset( $postVars["pwd"] ) ) {
			       echo H( $postVars["pwd"] );
		       } ?>"><br>
        <p class="red-text">
			<?php if ( isset( $pageErrors["pwd"] ) ) {
				echo H( $pageErrors["pwd"] );
			} ?></p>
    </div>

    <div class="input-field">
        <label for="pwd2">
			<?php echo $loc->getText( "adminStaff_new_form_Reenterpassword" ); ?>
        </label>

        <input type="password" name="pwd2" id="pwd2" size="20" maxlength="20"
               value="<?php if ( isset( $postVars["pwd2"] ) ) {
			       echo H( $postVars["pwd2"] );
		       } ?>"><br>
        <p class="red-text">
			<?php if ( isset( $pageErrors["pwd2"] ) ) {
				echo H( $pageErrors["pwd2"] );
			} ?></p>
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
