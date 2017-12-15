<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
session_cache_limiter(null);

$tab = "circulation";
$nav = "searchform";
$helpPage = "circulation";
$focus_form_name = "barcodesearch";
$focus_form_field = "searchText";

require_once("../shared/logincheck.php");
require_once("../shared/header.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);

if (isset($_REQUEST['msg'])) {
    echo '<div class="red">' . H($_REQUEST['msg']) . '</div>';
}
?>

<h3>
    <i class="material-icons small">repeat</i> <?php echo $loc->getText("indexHeading"); ?>
</h3>

<form name="barcodesearch" method="POST" action="../circ/mbr_search.php">

    <p class="flow-text">
        <?php echo $loc->getText("indexCardHdr"); ?>
    </p>

    <div class="input-field">
        <input type="text" id="searchText" name="searchText" size="20" maxlength="20" class="validate">
        <label for="searchText">
            <?php echo $loc->getText("indexCard"); ?>
        </label>
    </div>

    <input type="hidden" name="searchType" value="barcodeNmbr">

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">search</i><?php echo $loc->getText("indexSearch"); ?>
    </button>

</form>


<form name="phrasesearch" method="POST" action="../circ/mbr_search.php">

    <p class="flow-text">
        <?php echo $loc->getText("indexNameHdr"); ?>
    </p>

    <div class="input-field">
        <input type="text" id="searchText1" name="searchText" size="30" maxlength="80" class="validate">
        <label for="searchText1">
            <?php echo $loc->getText("indexName"); ?>
        </label>
    </div>

    <input type="hidden" name="searchType" value="lastName">

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">search</i><?php echo $loc->getText("indexSearch"); ?>
    </button>
</form>

<?php include("../shared/footer.php"); ?>
