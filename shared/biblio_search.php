<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

#****************************************************************************
#*  Checking for post vars.  Go back to form if none found.
#****************************************************************************
if ( count( $_POST ) == 0 ) {
	header( "Location: ../catalog/index.php" );
	exit();
}

#****************************************************************************
#*  Checking for tab name to show OPAC look and feel if searching from OPAC
#****************************************************************************
$tab      = "cataloging";
$helpPage = "biblioSearch";
$lookup   = "N";
if ( isset( $_POST["tab"] ) ) {
	$tab = $_POST["tab"];
}
if ( isset( $_POST["lookup"] ) ) {
	$lookup = $_POST["lookup"];
	if ( $lookup == 'Y' ) {
		$helpPage = "opacLookup";
	}
}

$nav = "search";
if ( $tab != "opac" ) {
	require_once( "../shared/logincheck.php" );
}
require_once( "../classes/BiblioSearch.php" );
require_once( "../classes/BiblioSearchQuery.php" );
require_once( "../functions/searchFuncs.php" );
require_once( "../classes/DmQuery.php" );

#****************************************************************************
#*  Function declaration only used on this page.
#****************************************************************************
function printResultPages( &$loc, $currPage, $pageCount, $sort ) {
	echo "<ul class=\"pagination\">";
	if ( $pageCount <= 1 ) {
		return false;
	}
//	echo $loc->getText( "biblioSearchResultPages" ) . ": ";
	if ( $currPage > 6 ) {
		echo "<li class=\"waves-effect\">";
		echo "<a href=\"javascript:changePage(" .
		     H( addslashes( 1 ) ) . ",'" .
		     H( addslashes( $sort ) ) . "')\">&laquo; " .
		     $loc->getText( "First" ) . "</a> ";
		echo "</li>";
	}
	if ( $currPage > 1 ) {
		echo "<li class=\"waves-effect\">";
		echo "<a href=\"javascript:changePage(" .
		     H( addslashes( $currPage - 1 ) ) . ",'" .
		     H( addslashes( $sort ) ) . "')\">" .
		     "<i class=\"material-icons\">chevron_left</i></a>";
		echo "</li>";
	}
	$start = $currPage - 5;
	$end   = $currPage + 5;
	if ( $start < 1 ) {
		$start = 1;
	}
	if ( $end > $pageCount ) {
		$end = $pageCount;
	}
	for ( $i = $start; $i <= $end; $i ++ ) {
		if ( $i == $currPage ) {
			echo "<li class=\"waves-effect active\"><a href='#'>";
			echo H( $i );
			echo "</a></li>";

		} else {
			echo "<li class=\"waves-effect\">";
			echo "<a href=\"javascript:changePage(" .
			     H( addslashes( $i ) ) . ",'" . H( addslashes( $sort ) )
			     . "')\">" . H( $i ) . "</a> ";
			echo "</li>";
		}
	}
	if ( $currPage < $pageCount ) {
		echo "<li class=\"waves-effect\">";
		echo "<a href=\"javascript:changePage(" . ( $currPage + 1 ) .
		     ",'" . $sort . "')\">" .
		     "<i class=\"material-icons\">chevron_right</i></a> ";
		echo "</li>";
	}
	if ( $currPage < $pageCount - 5 ) {
		echo "<li class=\"waves-effect\">";
		echo "<a href=\"javascript:changePage(" .
		     H( addslashes( $pageCount ) ) . ",'" .
		     H( addslashes( $sort ) ) . "')\">" .
		     $loc->getText( "Last" ) . " &raquo;</a> ";
		echo "</li>";
	}
	echo "</ul>";
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$collectionDm       = $dmQ->getAssoc( "collection_dm" );
$materialTypeDm     = $dmQ->getAssoc( "material_type_dm" );
$materialImageFiles = $dmQ->getAssoc( "material_type_dm", "image_file" );
$biblioStatusDm     = $dmQ->getAssoc( "biblio_status_dm" );
$dmQ->close();

#****************************************************************************
#*  Retrieving post vars and scrubbing the data
#****************************************************************************
if ( isset( $_POST["page"] ) ) {
	$currentPageNmbr = intval( $_POST["page"] );
} else {
	$currentPageNmbr = 1;
}
$searchType = $_POST["searchType"];
$sortBy     = $_POST["sortBy"];
if ( $sortBy == "default" ) {
	if ( $searchType == "author" ) {
		$sortBy = "author";
	} else {
		$sortBy = "title";
	}
}
$searchText = trim( $_POST["searchText"] );
# remove redundant whitespace
$searchText = preg_replace( '/\s+/', " ", $searchText );
if ( $searchType == "barcodeNmbr" ) {
	$sType   = OBIB_SEARCH_BARCODE;
	$words[] = $searchText;
} else {
	$words = explodeQuoted( $searchText );
	if ( $searchType == "author" ) {
		$sType = OBIB_SEARCH_AUTHOR;
	} elseif ( $searchType == "subject" ) {
		$sType = OBIB_SEARCH_SUBJECT;
	} elseif ( $searchType == "callno" ) {
		$sType = OBIB_SEARCH_CALLNO;
	} elseif ( $searchType == "keyword" ) {
		$sType = OBIB_SEARCH_KEYWORD;
	} else {
		$sType = OBIB_SEARCH_TITLE;
	}
}

#****************************************************************************
#*  Search database
#****************************************************************************
$biblioQ = new BiblioSearchQuery();
$biblioQ->setItemsPerPage( OBIB_ITEMS_PER_PAGE );
$biblioQ->connect();
if ( $biblioQ->errorOccurred() ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
# checking to see if we are in the opac search or logged in
if ( $tab == "opac" ) {
	$opacFlg = true;
} else {
	$opacFlg = false;
}
if ( ! $biblioQ->search( $sType, $words, $currentPageNmbr, $sortBy, $opacFlg ) ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}

# Redirect to biblio_view if only one result
if ( $biblioQ->getRowCount() == 1 && $lookup !== 'Y' ) {
	$biblio = $biblioQ->fetchRow();
	header( 'Location: ../shared/biblio_view.php?bibid=' . U( $biblio->getBibid() ) . '&tab=' . U( $tab ) );
	exit();
}

#**************************************************************************
#*  Show search results
#**************************************************************************
if ( $tab == "opac" ) {
	require_once( "../shared/header_opac.php" );
} else {
	require_once( "../shared/header.php" );
}
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, "shared" );

# Display no results message if no results returned from search.
if ( $biblioQ->getRowCount() == 0 ) {
	$biblioQ->close();
	echo $loc->getText( "biblioSearchNoResults" );
	require_once( "../shared/footer.php" );
	exit();
}
?>

<!--**************************************************************************
    *  Javascript to post back to this page
    ************************************************************************** -->
<script language="JavaScript" type="text/javascript">
    <!--
    function changePage(page, sort) {
        document.changePageForm.page.value = page;
        document.changePageForm.sortBy.value = sort;
        document.changePageForm.submit();
    }

    -->
</script>


<!--**************************************************************************
    *  Form used by javascript to post back to this page
    ************************************************************************** -->
<form name="changePageForm" method="POST" action="../shared/biblio_search.php">
    <input type="hidden" name="searchType" value="<?php echo H( $_POST["searchType"] ); ?>">
    <input type="hidden" name="searchText" value="<?php echo H( $_POST["searchText"] ); ?>">
    <input type="hidden" name="sortBy" value="<?php echo H( $_POST["sortBy"] ); ?>">
    <input type="hidden" name="lookup" value="<?php echo H( $lookup ); ?>">
    <input type="hidden" name="page" value="1">
    <input type="hidden" name="tab" value="<?php echo H( $tab ); ?>">
</form>

<h3>
	<?php echo $loc->getText( "biblioSearchResults" ); ?>
</h3>

<!--**************************************************************************
    *  Printing result stats and page nav
    ************************************************************************** -->
<?php
echo $loc->getText( "biblioSearchResultTxt", array( "items" => $biblioQ->getRowCount() ) );
if ( $biblioQ->getRowCount() > 1 ) {
	echo $loc->getText( "biblioSearch" . $sortBy );
	if ( $sortBy == "author" ) {
		echo "<a class=\"waves-effect waves-teal btn-flat\" href=\"javascript:changePage(" . $currentPageNmbr .
		     ",'title')\">" . $loc->getText( "biblioSearchSortByTitle" ) . "</a>";
	} else {
		echo "<a class=\"waves-effect waves-teal btn-flat\" href=\"javascript:changePage(" . $currentPageNmbr .
		     ",'author')\">" . $loc->getText( "biblioSearchSortByAuthor" ) . "</a>";
	}
}
?>
<div class="container center">
	<?php printResultPages( $loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy ); ?><br>
</div>

<!--**************************************************************************
    *  Printing result table
    ************************************************************************** -->
<ul class="collection">
	<?php
	$priorBibid = 0;
	while ( $biblio = $biblioQ->fetchRow() ) {
		?>

		<?php
		if ( $biblio->getBibid() == $priorBibid ) {
			if ( $biblio->getBarcodeNmbr() != "" ) {
				#************************************
				#* print copy line only
				#************************************
				?>
                <li class="collection-item copy-item">
					<?php /*echo H( $biblioQ->getCurrentRowNmbr() ); */ ?>

                    <strong><?php echo $loc->getText( "biblioSearchCopyBCode" ); ?>:</strong>
					<?php echo H( $biblio->getBarcodeNmbr() ); ?>

					<?php if ( $lookup == 'Y' ) { ?>
                        <a href="javascript:returnLookup('barcodesearch','barcodeNmbr','<?php echo H( addslashes( $biblio->getBarcodeNmbr() ) ); ?>')"><?php echo $loc->getText( "biblioSearchOutIn" ); ?></a> |
                        <a href="javascript:returnLookup('holdForm','holdBarcodeNmbr','<?php echo H( addslashes( $biblio->getBarcodeNmbr() ) ); ?>')"><?php echo $loc->getText( "biblioSearchHold" ); ?></a>
					<?php } ?>

                    <strong><?php echo $loc->getText( "biblioSearchCopyStatus" ); ?>:</strong>
					<?php echo H( $biblioStatusDm[ $biblio->getStatusCd() ] ); ?>
                </li>
				<?php
			}
		} else {
			$priorBibid = $biblio->getBibid();

			?>
            <li class="collection-item avatar">

            <i class="circle">
				<?php echo H( $biblioQ->getCurrentRowNmbr() ); ?>.
            </i>
            <span class="title">
                    <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $biblio->getBibid() ); ?>&amp;tab=<?php echo HURL( $tab ); ?>">
                        <img src="../images/<?php echo HURL( $materialImageFiles[ $biblio->getMaterialCd() ] ); ?>"
                             alt="<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>">

                        <!-- <?php echo $loc->getText( "biblioSearchTitle" ); ?>: -->

	                    <?php echo H( $biblio->getTitle() ); ?>
                    </a>
                </span>
            <p>
            <strong><?php echo $loc->getText( "biblioSearchTitleRemainder" ); ?>:</strong>
			<?php echo H( $biblio->getTitleRemainder() ); ?><br>


            <strong><?php echo $loc->getText( "biblioSearchAuthor" ); ?>:</strong>
			<?php if ( $biblio->getAuthor() != "" ) {
				echo H( $biblio->getAuthor() );
			} ?> <br>

            <strong><?php echo $loc->getText( "biblioSearchMaterial" ); ?>:</strong>
			<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?><br>

            <strong><?php echo $loc->getText( "biblioSearchCollection" ); ?>:</strong>
			<?php echo H( $collectionDm[ $biblio->getCollectionCd() ] ); ?><br>

            <strong><?php echo $loc->getText( "biblioSearchCall" ); ?>:</strong>
			<?php echo H( $biblio->getCallNmbr1() . " " . $biblio->getCallNmbr2() . " " . $biblio->getCallNmbr3() ); ?>
            <br>

			<?php
			if ( $biblio->getBarcodeNmbr() != "" ) {
				?>
                <strong><?php echo $loc->getText( "biblioSearchCopyBCode" ); ?>:</strong>
				<?php echo H( $biblio->getBarcodeNmbr() ); ?>
				<?php if ( $lookup == 'Y' ) { ?>
                    <a href="javascript:returnLookup('barcodesearch','barcodeNmbr','<?php echo H( addslashes( $biblio->getBarcodeNmbr() ) ); ?>')"><?php echo $loc->getText( "biblioSearchOutIn" ); ?></a> |
                    <a href="javascript:returnLookup('holdForm','holdBarcodeNmbr','<?php echo H( addslashes( $biblio->getBarcodeNmbr() ) ); ?>')"><?php echo $loc->getText( "biblioSearchHold" ); ?></a>
				<?php } ?>
                <strong><?php echo $loc->getText( "biblioSearchCopyStatus" ); ?>:</strong>
				<?php echo H( $biblioStatusDm[ $biblio->getStatusCd() ] ); ?>

			<?php } else { ?>
				<?php echo $loc->getText( "biblioSearchNoCopies" ); ?>

				<?php
			}
		}
		?>
        </p>
        </li>
		<?php
	}
	$biblioQ->close();
	?>
</ul>

<div class="container center">
	<?php printResultPages( $loc, $currentPageNmbr, $biblioQ->getPageCount(), $sortBy ); ?>
</div>

<?php require_once( "../shared/footer.php" ); ?>
