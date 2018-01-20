<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
session_cache_limiter(null);

$tab = "circulation";
$nav = "search";
require_once("../shared/logincheck.php");

require_once("../classes/Member.php");
require_once("../classes/MemberQuery.php");
require_once("../functions/searchFuncs.php");
require_once("../classes/DmQuery.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);

#****************************************************************************
#*  Function declaration only used on this page.
#****************************************************************************
function printResultPages($currPage, $pageCount)
{
    echo "<ul class=\"pagination\">";
    global $loc;
    if ($currPage > 6) {
        echo "<li class=\"waves-effect\">";
        echo "<a href=\"javascript:changePage(" . H(addslashes(1)) .
            ")\">&laquo;" .
            $loc->getText("First") . "</a> ";
        echo "</li>";
    }
    if ($currPage > 1) {
        echo "<li class=\"waves-effect\">";
        echo "<a href=\"javascript:changePage(" . H(addslashes($currPage - 1)) .
            ")\" class=\"\">" .
            "<i class=\"material-icons\">chevron_left</i></a> ";
        echo "</li>";
    }
    $start = $currPage - 5;
    $end = $currPage + 5;
    if ($start < 1) $start = 1;
    if ($end > $pageCount) $end = $pageCount;
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currPage) {
            if ($pageCount > 1) {
                echo "<li class=\"waves-effect active\">";
                echo "<a href=\"#\">"
                    . H($i) . "</a> ";
                echo "</li>";
            }
        } else {
            echo "<li class=\"waves-effect\">";
            echo "<a href=\"javascript:changePage(" . H(addslashes($i)) .
                ")\"> " . H($i) . "</a> ";
            echo "</li>";
        }
    }
    if ($currPage < $pageCount) {
        echo "<li class=\"waves-effect\">";
        echo "<a href=\"javascript:changePage(" . ($currPage + 1) .
            ")\">" .
            "<i class=\"material-icons\">chevron_right</i></a> ";
        echo "</li>";
    }
    if ($currPage < $pageCount - 5) {
        echo "<li class=\"waves-effect\">";
        echo "<a href=\"javascript:changePage(" . ($pageCount) .
            ")\">" .
            $loc->getText("Last") . "&raquo;</a> ";
        echo "</li>";
    }
    echo "</ul>";
}

#****************************************************************************
#*  Checking for post vars.  Go back to form if none found.
#****************************************************************************
if (count($_POST) == 0) {
    header("Location: ../circ/index.php");
    exit();
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm = $dmQ->getAssoc("mbr_classify_dm");
$dmQ->close();

#****************************************************************************
#*  Retrieving post vars and scrubbing the data
#****************************************************************************
if (isset($_POST["page"])) {
    $currentPageNmbr = $_POST["page"];
} else {
    $currentPageNmbr = 1;
}
$searchType = $_POST["searchType"];
$searchText = trim($_POST["searchText"]);
# remove redundant whitespace
$searchText = preg_replace('/\s+/', " ", $searchText);

if ($searchType == "barcodeNmbr") {
    $sType = OBIB_SEARCH_BARCODE;
} else {
    $sType = OBIB_SEARCH_NAME;
}

#****************************************************************************
#*  Search database
#****************************************************************************
$mbrQ = new MemberQuery();
$mbrQ->setItemsPerPage(OBIB_ITEMS_PER_PAGE);
$mbrQ->connect();
$mbrQ->execSearch($sType, $searchText, $currentPageNmbr);

#**************************************************************************
#*  Show member view screen if only one result from barcode query
#**************************************************************************
if (($sType == OBIB_SEARCH_BARCODE) && ($mbrQ->getRowCount() == 1)) {
    $mbr = $mbrQ->fetchMember();
    $mbrQ->close();
    header("Location: ../circ/mbr_view.php?mbrid=" . U($mbr->getMbrid()) . "&reset=Y");
    exit();
}

#**************************************************************************
#*  Show search results
#**************************************************************************
require_once("../shared/header.php");

# Display no results message if no results returned from search.
if ($mbrQ->getRowCount() == 0) {
    $mbrQ->close();
    echo $loc->getText("mbrsearchNoResults");
    require_once("../shared/footer.php");
    exit();
}
?>

<!--**************************************************************************
    *  Javascript to post back to this page
    ************************************************************************** -->
<script language="JavaScript" type="text/javascript">
    <!--
    function changePage(page) {
        document.changePageForm.page.value = page;
        document.changePageForm.submit();
    }

    -->
</script>


<!--**************************************************************************
    *  Form used by javascript to post back to this page
    ************************************************************************** -->
<form name="changePageForm" method="POST" action="../circ/mbr_search.php">
    <input type="hidden" name="searchType" value="<?php echo H($_POST["searchType"]); ?>">
    <input type="hidden" name="searchText" value="<?php echo H($_POST["searchText"]); ?>">
    <input type="hidden" name="page" value="1">
</form>

<!--**************************************************************************
    *  Printing result stats and page nav
    ************************************************************************** -->
<h3><?php echo $loc->getText("mbrsearchSearchResults"); ?></h3>


<p>
    <?php echo H($mbrQ->getRowCount());
    echo $loc->getText("mbrsearchFoundResults"); ?>
</p>

<div class="container center">
    <?php printResultPages($currentPageNmbr, $mbrQ->getPageCount()); ?>
</div>

<!--**************************************************************************
    *  Printing result table
    ************************************************************************** -->

<ul class="collection">
    <?php
    while ($mbr = $mbrQ->fetchMember()) {
        ?>
        <li class="collection-item avatar">
            <i class="circle"> <?php echo H($mbrQ->getCurrentRowNmbr()); ?>.</i>

            <span class="title">
                <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbr->getMbrid()); ?>&amp;reset=Y">
                    <?php echo H($mbr->getLastName()); ?>, <?php echo H($mbr->getFirstName()); ?>
                </a>
            </span>
            <!--            --><?php
	        //            if ($mbr->getAddress() != "")
	        //                echo str_replace("\n", "<br />", H($mbr->getAddress())) . '<br />';
	        //            ?>
            <p>
                <strong><?php echo $loc->getText( "mbrsearchCardNumber" ); ?></strong>
                <?php echo H($mbr->getBarcodeNmbr()); ?><br>
                <strong><?php echo $loc->getText( "mbrsearchClassification" ); ?></strong>
                <?php echo H($mbrClassifyDm[$mbr->getClassification()]); ?>
            </p>

        </li>
        <?php
    }
    $mbrQ->close();
    ?>
</ul>

<div class="container center">
    <?php printResultPages($currentPageNmbr, $mbrQ->getPageCount()); ?>
</div>

<?php require_once("../shared/footer.php"); ?>
