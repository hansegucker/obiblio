<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
$tab = "circulation";
$nav = "hist";

require_once("../functions/inputFuncs.php");
require_once("../shared/logincheck.php");
require_once("../classes/BiblioStatusHist.php");
require_once("../classes/BiblioStatusHistQuery.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if (count($_GET) == 0) {
    header("Location: ../circ/index.php");
    exit();
}

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$mbrid = $_GET["mbrid"];

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm = $dmQ->getAssoc("mbr_classify_dm");
$biblioStatusDm = $dmQ->getAssoc("biblio_status_dm");
$materialTypeDm = $dmQ->getAssoc("material_type_dm");
$materialImageFiles = $dmQ->getAssoc("material_type_dm", "image_file");
$dmQ->close();

#****************************************************************************
#*  Search database for member history
#****************************************************************************
$histQ = new BiblioStatusHistQuery();
$histQ->connect();
if ($histQ->errorOccurred()) {
    $histQ->close();
    displayErrorPage($histQ);
}
if (!$histQ->queryByMbrid($mbrid)) {
    $histQ->close();
    displayErrorPage($histQ);
}

#**************************************************************************
#*  Show biblio checkout history
#**************************************************************************
require_once("../shared/header.php");
?>

<h3>
	<?php echo $loc->getText( "mbrHistoryHead1" ); ?>
</h3>

<table>
    <tr>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr1"); ?>
        </th>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr2"); ?>
        </th>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr3"); ?>
        </th>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr4"); ?>
        </th>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr5"); ?>
        </th>
        <th>
            <?php echo $loc->getText("mbrHistoryHdr6"); ?>
        </th>
    </tr>

    <?php
    if ($histQ->getRowCount() == 0) {
        ?>
        <tr>
            <td>
                <?php echo $loc->getText("mbrHistoryNoHist"); ?>
            </td>
        </tr>
        <?php
    } else {
        while ($hist = $histQ->fetchRow()) {
            ?>
            <tr>
                <td>
                    <?php echo H($hist->getBiblioBarcodeNmbr()); ?>
                </td>
                <td>
                    <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $hist->getBibid() ); ?>&amp;tab=cataloging">
			            <?php echo H( $hist->getTitle() ); ?>
                    </a>
                </td>
                <td>
                    <?php echo H($hist->getAuthor()); ?>
                </td>
                <td>
                    <?php echo H($biblioStatusDm[$hist->getStatusCd()]); ?>
                </td>
                <td>
                    <?php echo H($hist->getStatusBeginDt()); ?>
                </td>
                <td>
                    <?php echo H($hist->getDueBackDt()); ?>
                </td>
            </tr>
            <?php
        }
    }
    $histQ->close();

    ?>
</table>

<?php require_once("../shared/footer.php"); ?>
