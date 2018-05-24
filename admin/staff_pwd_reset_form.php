<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab              = "admin";
$nav              = "staff";
$focus_form_name  = "pwdresetform";
$focus_form_field = "pwd";

include( "../shared/logincheck.php" );
include( "../shared/header.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Checking for query string flag to read data from database.
#****************************************************************************
if ( isset( $_GET["UID"] ) ) {
	unset( $_SESSION["postVars"] );
	unset( $_SESSION["pageErrors"] );

	$postVars["userid"] = $_GET["UID"];
} else {
	require( "../shared/get_form_vars.php" );
}

?>

<form name="pwdresetform" method="POST" action="../admin/staff_pwd_reset.php">
    <input type="hidden" name="userid" value="<?php echo H( $postVars["userid"] ); ?>">

    <h3><?php echo $loc->getText( "adminStaff_pwd_reset_form_Resetheader" ); ?></h3>

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
			} ?>
        </p>
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
			} ?>
        </p>
    </div>


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
