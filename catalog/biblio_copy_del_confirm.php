<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "cataloging";
$nav = "view";
require_once( "../shared/logincheck.php" );

require_once( "../classes/BiblioCopy.php" );
require_once( "../classes/BiblioCopyQuery.php" );
require_once( "../classes/DmQuery.php" );
require_once( "../functions/errorFuncs.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$bibid  = $_GET["bibid"];
$copyid = $_GET["copyid"];

#****************************************************************************
#*  Ready copy information
#****************************************************************************
$copyQ = new BiblioCopyQuery();
$copyQ->connect();
if ( $copyQ->errorOccurred() ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
if ( ! $copy = $copyQ->doQuery( $bibid, $copyid ) ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
$copyQ->close();

#****************************************************************************
#*  Make sure copy is checked in before it is deleted
#****************************************************************************
if ( $copy->getStatusCd() == OBIB_STATUS_OUT ) {
	$msg = $loc->getText( "biblioCopyDelConfirmErr1" );
	header( "Location: ../shared/biblio_view.php?bibid=" . U( $bibid ) . "&msg=" . U( $msg ) );
	exit();
}


#**************************************************************************
#*  Show confirm page
#**************************************************************************
require_once( "../shared/header.php" );
?>
<div class="container">
    <form name="delcopyform" method="POST"
          action="../catalog/biblio_copy_del.php?bibid=<?php echo HURL( $bibid ); ?>&amp;copyid=<?php echo HURL( $copyid ); ?>&amp;barcode=<?php echo HURL( $copy->getBarcodeNmbr() ); ?>">

        <p class="flow-text">
		    <?php echo $loc->getText( "biblioCopyDelConfirmMsg", array( "barcodeNmbr" => $copy->getBarcodeNmbr() ) ); ?>
        </p>

        <button type="submit" class="waves-effect waves-light btn red">
            <i class="material-icons left">delete</i>
		    <?= $loc->getText( "catalogDelete" ) ?>
        </button>

        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>"
           class="waves-effect waves-light btn red">
            <i class="material-icons left">cancel</i>
		    <?= $loc->getText( "catalogCancel" ) ?>
        </a>
    </form>
</div>
<?php include( "../shared/footer.php" ); ?>
