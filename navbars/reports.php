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
Nav::node('reportlist', $navLoc->getText("Report List"), '../reports/index.php');
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

Nav::display("$nav");
?>
