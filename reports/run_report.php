<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");

require_once("../classes/Report.php");
require_once("../classes/Table.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, "reports");

$tab = "reports";
$nav = "results";
if (isset($_REQUEST['tab'])) {
    $tab = $_REQUEST['tab'];
}
if (isset($_REQUEST['nav'])) {
    $nav = $_REQUEST['nav'];
}
require_once("../shared/logincheck.php");

if (isset($_REQUEST['rpt___format'])) {
    $format = $_REQUEST['rpt___format'];
} else {
    $format = 'paged';
}

function echolink($page, $text, $newSort = NULL)
{
    global $tab, $nav, $format;
    echo '<li class="waves-effect"> <a href="../reports/run_report.php?type=previous';
    echo '&amp;rpt___format=' . HURL($format);
    echo '&amp;tab=' . HURL($tab) . '&amp;nav=' . HURL($nav);
    echo '&amp;page=' . HURL($page);
    if ($newSort) {
        echo '&amp;rpt_order_by=' . HURL($newSort);
    }
    echo '">'
        . $text
        . '</a> </li>';
}

function printResultPages(&$loc, $currPage, $pageCount)
{
    if ($pageCount <= 1) {
        return false;
    }
    echo "<ul class='pagination center'>";
    if ($currPage > 6) {
        echolink(1, '<i class="material-icons">arrow_back</i>');
        echo ' ';
    }
    if ($currPage > 1) {
        echolink($currPage - 1, '<i class="material-icons">chevron_left</i>');
        echo ' ';
    }
    $start = $currPage - 5;
    $end = $currPage + 5;
    if ($start < 1) $start = 1;
    if ($end > $pageCount) $end = $pageCount;
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currPage) {
	        echo "<li class='active'><a>" . $i . "</a></li> ";
        } else {
            echolink($i, $i);
            echo ' ';
        }
    }
    if ($currPage < $pageCount) {
        echolink($currPage + 1, '<i class="material-icons">chevron_right</i>');
        echo ' ';
    }
    if ($currPage < $pageCount - 5) {
        echolink($pageCount, '<i class="material-icons">arrow_forward</i>');
        echo ' ';
    }
    echo "</ul>";
}

if (!$_REQUEST['type']) {
    header('Location: ../reports/index.php');
    exit(0);
}
if ($_REQUEST['type'] == 'previous') {
    $rpt = Report::load('Report');
} else {
    list($rpt, $err) = Report::create_e($_REQUEST['type'], 'Report');
    if ($err) {
        $rpt = NULL;
    }
}
if (!$rpt) {
    header('Location: ../reports/index.php');
    exit(0);
}

if ($_REQUEST['type'] == 'previous') {
    if (isset($_REQUEST['rpt_order_by'])) {
        list($rpt, $errs) = $rpt->variant_el(array('order_by' => $_REQUEST['rpt_order_by']));
        assert('empty($errs)');
    }
} else {
    $errs = $rpt->initCgi_el();
    if (!empty($errs)) {
        $_SESSION['postVars'] = mkPostVars();
        $_SESSION['pageErrors'] = array();
        foreach ($errs as $k => $e) {
            $_SESSION['pageErrors'][$k] = $e->toStr();
        }
        header('Location: ../reports/report_criteria.php?msg=' . U('Incorrect parameters, see below:'));
        exit();
    }
}
if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
} else {
    $page = $rpt->curPage();
}

foreach ($rpt->layouts() as $l) {
    if ($l['title']) {
        $title = $l['title'];
    } else {
        $title = $l['name'];
    }
    Nav::node('results/' . $l['name'], $loc->getText($title),
        '../shared/layout.php?rpt=Report&name=' . U($l['name']));
}

if ($format == 'csv') {
    include_once('../classes/CsvTable.php');
    $table = new CsvTable;
    header('Content-type: text/csv;header=yes');
    header('Content-disposition: inline; filename="' . $rpt->type() . '.csv"');
    $rpt->table($table);
    exit;
}

include('../shared/header.php');
?><h1><?php echo $loc->getText("Report Results:"); ?></h1><?php

if (isset($_REQUEST["msg"]) && !empty($_REQUEST["msg"])) {
    echo "<font class=\"error\">" . H($_REQUEST["msg"]) . "</font><br><br>";
}

if ($rpt->count() == 0) {
    echo $loc->getText("No results found.");
    require_once("../shared/footer.php");
    exit();
}

echo '<p>' . $rpt->count() . ' ' . $loc->getText("results found.") . '</p>';
if ($format == 'paged') {
    printResultPages($loc, $page, ceil($rpt->count() / OBIB_ITEMS_PER_PAGE));
}
?>

<?php
if ($format == 'paged') {
    $rpt->pageTable($page, new Table('echolink'));
    printResultPages($loc, $page, ceil($rpt->count() / OBIB_ITEMS_PER_PAGE));
} else {
    $rpt->table(new Table('echolink'));
}

include('../shared/footer.php');
?>
