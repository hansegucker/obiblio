<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
$tab = "home";
$nav = "home";

require_once("../shared/header.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);
?>
<h1><?php echo $loc->getText("indexHeading"); ?></h1>

<?php
# echo $loc->getText("searchResults",array("items"=>0))."<br>";
?>

<p class="flow-text"><?php echo $loc->getText("indexIntro"); ?></p>

<table>
    <thead>
    <tr>
        <th><?php echo $loc->getText("indexTab"); ?></th>
        <th><?php echo $loc->getText("indexDesc"); ?></th>
    </tr>
    </thead>

    <tr>
        <td>
            <h4>
                <i class="material-icons">repeat</i>
                <?php echo $loc->getText("indexCirc"); ?>
            </h4>
        </td>

        <td>
            <strong><?php echo $loc->getText("indexCircDesc1"); ?></strong>
            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc3"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc4"); ?></li>
            </ul>
        </td>
    </tr>

    <tr>

        <td>
            <h4>
                <i class="material-icons">library_books</i>
                <?php echo $loc->getText("indexCat"); ?>
            </h4>
        </td>

        <td>
            <strong><?php echo $loc->getText("indexCatDesc1"); ?></strong>

            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexCatDesc2"); ?></li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <h4>
                <i class="material-icons">settings</i>
                <?php echo $loc->getText("indexAdmin"); ?>
            </h4>
        </td>

        <td>
            <strong><?php echo $loc->getText("indexAdminDesc1"); ?></strong>

            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc3"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc4"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc5"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc6"); ?></li>
            </ul>
        </td>
    </tr>

    <tr>
        <td>
            <h4>
                <i class="material-icons">print</i>
                <?php echo $loc->getText("indexReports"); ?>
            </h4>
        </td>

        <td>
            <strong><?php echo $loc->getText("indexReportsDesc1"); ?></strong>

            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexReportsDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexReportsDesc3"); ?></li>
            </ul>
        </td>
    </tr>
</table>

<?php include("../shared/footer.php"); ?>
