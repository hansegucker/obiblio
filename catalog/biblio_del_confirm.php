<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "cataloging";
$nav = "delete";
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioQuery.php" );
require_once( "../classes/BiblioCopyQuery.php" );
require_once( "../classes/BiblioHoldQuery.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

$bibid   = $_GET["bibid"];
$biblioQ = new BiblioQuery();
$biblioQ->connect();
if ( $biblioQ->errorOccurred() ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
$biblio = $biblioQ->doQuery( $bibid );
if ( $biblioQ->errorOccurred() ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
$biblioFlds = $biblio->getBiblioFields();
$title      = '';
if ( isset( $biblioFlds["245a"] ) ) {
	$title .= $biblioFlds["245a"]->getFieldData();
}
if ( isset( $biblioFlds["245b"] ) ) {
	$title .= $biblioFlds["245b"]->getFieldData();
}
$biblioQ->close();


#****************************************************************************
#*  Check for copies and holds
#****************************************************************************
$copyQ = new BiblioCopyQuery();
$copyQ->connect();
if ( $copyQ->errorOccurred() ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
$copyQ->execSelect( $bibid );
if ( $copyQ->errorOccurred() ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
$copyCount = $copyQ->getRowCount();
$copyQ->close();

$holdQ = new BiblioHoldQuery();
$holdQ->connect();
if ( $holdQ->errorOccurred() ) {
	$holdQ->close();
	displayErrorPage( $holdQ );
}
$holdQ->queryByBibid( $bibid );
if ( $holdQ->errorOccurred() ) {
	$holdQ->close();
	displayErrorPage( $holdQ );
}
$holdCount = $holdQ->getRowCount();
$holdQ->close();

#**************************************************************************
#*  Show confirm page
#**************************************************************************
require_once( "../shared/header.php" );

if ( ( $copyCount > 0 ) or ( $holdCount > 0 ) ) {
	?>
    <div class="container">
        <p class="flow-text">
			<?php echo $loc->getText( "biblioDelConfirmWarn", array(
				"copyCount" => $copyCount,
				"holdCount" => $holdCount
			) ); ?>
        </p>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>"
           class="waves-effect waves-light btn">
            <i class="material-icons left">arrow_back</i>
			<?php echo $loc->getText( "biblioDelConfirmReturn" ); ?>
        </a>
    </div>

	<?php
} else {
	?>
    <div class="container">
        <form name="delbiblioform" method="POST" action="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <p class="flow-text">
				<?php echo $loc->getText( "biblioDelConfirmMsg", array( "title" => $title ) ); ?>
            </p>

            <a href="../catalog/biblio_del.php?bibid=<?php echo HURL( $bibid ); ?>&amp;title=<?php echo HURL( $title ); ?>"
               class="waves-effect waves-light btn red">
                <i class="material-icons left">delete</i>
				<?php echo $loc->getText( "catalogDelete" ); ?>
            </a>
            <button type="submit" class="waves-effect waves-light btn red">
                <i class="material-icons left">cancel</i>
				<?php echo $loc->getText( "catalogCancel" ); ?>
            </button>
        </form>
    </div>
	<?php
}
include( "../shared/footer.php" );
?>
