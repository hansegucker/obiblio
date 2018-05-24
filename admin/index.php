<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");
$tab = "admin";
$nav = "summary";

include("../shared/logincheck.php");
include("../shared/header.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, $tab);

?>

<h3><i class="material-icons small">settings</i> <?php echo $loc->getText( "indexHdr" ); ?></h3>
<p class="flow-text">
	<?php echo $loc->getText( "indexDesc" ); ?>
</p>

<?php include("../shared/footer.php"); ?>
