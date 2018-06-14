<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../classes/Localize.php");
$navLoc = new Localize(OBIB_LOCALE, "navbars");


if (isset($_SESSION["userid"])) {
    $sess_userid = $_SESSION["userid"];
} else {
    $sess_userid = "";
}
?>

<?php if ($nav == "home") { ?>
    <li><a href="#" class="disabled"><i class="material-icons">home</i>
            &raquo; <?php echo $navLoc->getText("homeHomeLink"); ?></a></li>
<?php } else { ?>
    <li><a href="../home/index.php"><i
                    class="material-icons">home</i> <?php echo $navLoc->getText("homeHomeLink"); ?></a></li>
<?php } ?>

<?php if ($nav == "license") { ?>
    <li><a href="#" class="disabled"><i class="material-icons">copyright</i>
            &raquo; <?php echo $navLoc->getText("homeLicenseLink"); ?></a></li>
<?php } else { ?>
    <li><a href="../home/license.php"><i
                    class="material-icons">copyright</i> <?php echo $navLoc->getText("homeLicenseLink"); ?></a></li>
<?php } ?>
