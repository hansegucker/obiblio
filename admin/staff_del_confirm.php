<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "admin";
$nav = "staff";
require_once( "../shared/logincheck.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Checking for query string.  Go back to staff list if none found.
#****************************************************************************
if ( ! isset( $_GET["UID"] ) ) {
	header( "Location: ../admin/staff_list.php" );
	exit();
}
$uid        = $_GET["UID"];
$last_name  = $_GET["LAST"];
$first_name = $_GET["FIRST"];

#**************************************************************************
#*  Show confirm page
#**************************************************************************
require_once( "../shared/header.php" );
?>
<div class="container">
    <form name="delstaffform" method="POST"
          action="../admin/staff_del.php?UID=<?php echo HURL( $uid ); ?>&amp;LAST=<?php echo HURL( $last_name ); ?>&amp;FIRST=<?php echo HURL( $first_name ); ?>">
        <p class="flow-text">
		    <?php echo $loc->getText( "adminStaff_del_confirmConfirmText" ); ?>
            <em><?php echo H( $first_name ); ?><?php echo H( $last_name ); ?></em>?
        </p>

        <button type="submit" class="waves-effect waves-light btn red">
            <i class="material-icons left">delete</i>
		    <?php echo $loc->getText( "adminDelete" ); ?>
        </button>
        <a href="../admin/staff_list.php" class="waves-effect waves-light btn red">
            <i class="material-icons left">cancel</i>
		    <?php echo $loc->getText( "adminCancel" ); ?>
        </a>
    </form>
</div>
<?php include( "../shared/footer.php" ); ?>
