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
<h3><?php echo $loc->getText("indexHeading"); ?></h3>

<?php
# echo $loc->getText("searchResults",array("items"=>0))."<br>";
?>

<p class="flow-text"><?php echo $loc->getText("indexIntro"); ?></p>
	<div class="row">
		<div class="col s12 m3">
          <div class="icon-block">
            <h2 class="center"><i class="material-icons large red-kath">repeat</i></h2>
            <h5 class="center"><?php echo $loc->getText("indexCirc"); ?></h5>

            <strong><?php echo $loc->getText("indexCircDesc1"); ?></strong>
            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc3"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexCircDesc4"); ?></li>
            </ul>
          </div>
		</div>
		<div class="col s12 m3">
          <div class="icon-block">
            <h2 class="center"><i class="material-icons large red-kath">library_books</i></h2>
            <h5 class="center"><?php echo $loc->getText("indexCat"); ?></h5>

            <strong><?php echo $loc->getText("indexCatDesc1"); ?></strong>
            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexCatDesc2"); ?></li>
            </ul>
          </div>
		</div>
		<div class="col s12 m3">
          <div class="icon-block">
            <h2 class="center"><i class="material-icons large red-kath">settings</i></h2>
            <h5 class="center"><?php echo $loc->getText("indexAdmin"); ?></h5>

            <strong><?php echo $loc->getText("indexAdminDesc1"); ?></strong>
            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc3"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc4"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc5"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexAdminDesc6"); ?></li>
            </ul>
          </div>
		</div>
		<div class="col s12 m3">
          <div class="icon-block">
            <h2 class="center"><i class="material-icons large red-kath">print</i></h2>
            <h5 class="center"><?php echo $loc->getText("indexReports"); ?></h5>

            <strong><?php echo $loc->getText("indexReportsDesc1"); ?></strong>
            <ul class="collection">
                <li class="collection-item"><?php echo $loc->getText("indexReportsDesc2"); ?></li>
                <li class="collection-item"><?php echo $loc->getText("indexReportsDesc3"); ?></li>
            </ul>
         </div>
      </div>
	</div>


<?php include("../shared/footer.php"); ?>
