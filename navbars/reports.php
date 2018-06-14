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
<?php
/*Nav::node('reportlist', $navLoc->getText("Report List"), '../reports/index.php');
if (isset($_SESSION['rpt_Report'])) {
    Nav::node('results', $navLoc->getText("Report Results"),
        '../reports/run_report.php?type=previous');
}

$helpurl = "javascript:popSecondary('../shared/help.php";
if (isset($helpPage)) {
    $helpurl .= "?page=" . $helpPage;
}
$helpurl .= "')";
Nav::node('help', $navLoc->getText("help"), $helpurl);

Nav::display("$nav");*/
?>
<?php if ($nav == "reportlist") { ?>
    <li><a href="#" class="disabled"><i class="material-icons">home</i>
            &raquo; <?php echo $navLoc->getText("Report List"); ?></a></li>
<?php } else { ?>
    <li><a href="../reports/index.php"><i
                    class="material-icons">home</i> <?php echo $navLoc->getText("Report List"); ?></a></li>
<?php } ?>

<?php if ($nav == "reportcriteria") { ?>
    <li><a href="#" class="disabled"><i class="material-icons">filter_list</i>
            &raquo; <?php echo $loc->getText("Report Criteria"); ?></a></li>
<?php } else if ($nav == "results") { ?>
    <li><a href="../reports/report_criteria.php?type=<?= U($rpt->type()) ?>"><i
                    class="material-icons">filter_list</i> <?php echo $loc->getText("Report Criteria"); ?></a></li>
<?php } ?>



<?php if ($nav == "results") { ?>
    <li><a href="#" class="disabled"><i class="material-icons">list</i>
            &raquo; <?php echo $navLoc->getText("Report Results"); ?></a></li>
<?php } else if ($nav == "reportcriteria") { ?>
    <li><a href="../reports/run_report.php?type=previous"><i
                    class="material-icons">list</i> <?php echo $navLoc->getText("Report Results"); ?></a></li>
<?php } ?>

<?php if ($nav == "results") { ?>
    <li><a href="../shared/layout.php?rpt=Report&name=list"><i
                    class="material-icons">print</i> <?php echo $loc->getText("Print list"); ?></a></li>
<?php } ?>
