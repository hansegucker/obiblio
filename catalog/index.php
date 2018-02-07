<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "cataloging";
$nav              = "searchform";
$focus_form_name  = "barcodesearch";
$focus_form_field = "searchText";

require_once( "../shared/logincheck.php" );
require_once( "../shared/header.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );
if ( isset( $_GET["msg"] ) ) {
	$msg = "<p class=\"red-text\">" . H( $_GET["msg"] ) . "</p>";
} else {
	$msg = "";
}

?>
<h3>
    <i class="material-icons small">library_books</i>
	<?php echo $loc->getText( "indexHdr" ); ?>
</h3>

<form name="barcodesearch" method="POST" action="../shared/biblio_search.php">
    <p class="flow-text">
		<?php echo $loc->getText( "indexBarcodeHdr" ); ?>:
    </p>


    <div class="input-field">
        <input type="text" name="searchText" size="20" maxlength="20">
        <label for="searchText">
			<?php echo $loc->getText( "indexBarcodeField" ); ?>
        </label>
    </div>

    <!-- Hiden fields -->
    <input type="hidden" name="searchType" value="barcodeNmbr">
    <input type="hidden" name="sortBy" value="default">

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">search</i>
		<?php echo $loc->getText( "indexButton" ); ?>
    </button>

</form>


<form name="phrasesearch" method="POST" action="../shared/biblio_search.php" class="row">
    <p class="flow-text">
		<?php echo $loc->getText( "indexSearchHdr" ); ?>:
    </p>

    <div class="input-field col s12 m2">
        <select name="searchType">
            <option value="keyword" selected><?php echo $loc->getText( "indexKeyword" ); ?>
            <option value="author"><?php echo $loc->getText( "indexAuthor" ); ?>
            <option value="title"><?php echo $loc->getText( "indexTitle" ); ?>
            <option value="subject"><?php echo $loc->getText( "indexSubject" ); ?>
            <option value="callno"><?php echo $loc->getText( "biblioFieldsCallNmbr" ); ?>
        </select>
    </div>

    <div class="input-field col s12 m10">
        <input type="text" name="searchText" size="30" maxlength="256">
    </div>

    <!-- Hiden fields -->
    <input type="hidden" name="sortBy" value="default">

    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">search</i><?php echo $loc->getText( "indexButton" ); ?>
    </button>

</form>
<?php echo $msg ?>

<?php include( "../shared/footer.php" ); ?>
