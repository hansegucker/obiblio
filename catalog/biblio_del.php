<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab            = "cataloging";
$nav            = "deletedone";
$restrictInDemo = true;
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioQuery.php" );
require_once( "../functions/errorFuncs.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

$bibid = $_GET["bibid"];
$title = $_GET["title"];

#**************************************************************************
#*  Delete Bibliography
#**************************************************************************
$biblioQ = new BiblioQuery();
$biblioQ->connect();
if ( $biblioQ->errorOccurred() ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
if ( ! $biblioQ->delete( $bibid ) ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
$biblioQ->close();

#**************************************************************************
#*  Show success page
#**************************************************************************
require_once( "../shared/header.php" );
?>
<div class="container">
    <p class="flow-text">
		<?php echo $loc->getText( "biblioDelMsg", array( "title" => $title ) ); ?>
    </p>

    <a href="../catalog/index.php" class="waves-effect waves-light btn">
        <i class="material-icons left">arrow_back</i>
		<?php echo $loc->getText( "biblioDelReturn" ); ?>
    </a>
</div>

<?php require_once( "../shared/footer.php" ); ?>
