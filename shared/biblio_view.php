<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if ( count( $_GET ) == 0 ) {
	header( "Location: ../catalog/index.php" );
	exit();
}

#****************************************************************************
#*  Checking for tab name to show OPAC look and feel if searching from OPAC
#****************************************************************************
if ( isset( $_GET["tab"] ) ) {
	$tab = $_GET["tab"];
} else {
	$tab = "cataloging";
}

$nav = "view";
if ( $tab != "opac" ) {
	require_once( "../shared/logincheck.php" );
}
require_once( "../classes/Biblio.php" );
require_once( "../classes/BiblioQuery.php" );
require_once( "../classes/BiblioCopy.php" );
require_once( "../classes/BiblioCopyQuery.php" );
require_once( "../classes/DmQuery.php" );
require_once( "../classes/UsmarcTagDm.php" );
require_once( "../classes/UsmarcTagDmQuery.php" );
require_once( "../classes/UsmarcSubfieldDm.php" );
require_once( "../classes/UsmarcSubfieldDmQuery.php" );
require_once( "../functions/marcFuncs.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, "shared" );


#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$bibid = $_GET["bibid"];
if ( isset( $_GET["msg"] ) ) {
	$msg = "<p class=\"red-text\">" . H( $_GET["msg"] ) . "</p><br><br>";
} else {
	$msg = "";
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$collectionDm   = $dmQ->getAssoc( "collection_dm" );
$materialTypeDm = $dmQ->getAssoc( "material_type_dm" );
$biblioStatusDm = $dmQ->getAssoc( "biblio_status_dm" );
$dmQ->close();

$marcTagDmQ = new UsmarcTagDmQuery();
$marcTagDmQ->connect();
if ( $marcTagDmQ->errorOccurred() ) {
	$marcTagDmQ->close();
	displayErrorPage( $marcTagDmQ );
}
$marcTagDmQ->execSelect();
if ( $marcTagDmQ->errorOccurred() ) {
	$marcTagDmQ->close();
	displayErrorPage( $marcTagDmQ );
}
$marcTags = $marcTagDmQ->fetchRows();
$marcTagDmQ->close();

$marcSubfldDmQ = new UsmarcSubfieldDmQuery();
$marcSubfldDmQ->connect();
if ( $marcSubfldDmQ->errorOccurred() ) {
	$marcSubfldDmQ->close();
	displayErrorPage( $marcSubfldDmQ );
}
$marcSubfldDmQ->execSelect();
if ( $marcSubfldDmQ->errorOccurred() ) {
	$marcSubfldDmQ->close();
	displayErrorPage( $marcSubfldDmQ );
}
$marcSubflds = $marcSubfldDmQ->fetchRows();
$marcSubfldDmQ->close();


#****************************************************************************
#*  Search database
#****************************************************************************
$biblioQ = new BiblioQuery();
$biblioQ->connect();
if ( $biblioQ->errorOccurred() ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
if ( ! $biblio = $biblioQ->doQuery( $bibid, $tab ) ) {
	$biblioQ->close();
	displayErrorPage( $biblioQ );
}
$biblioFlds = $biblio->getBiblioFields();

#**************************************************************************
#*  Show bibliography info.
#**************************************************************************
if ( $tab == "opac" ) {
	require_once( "../shared/header_opac.php" );
	if ( ! $biblio->showInOpac() ) {
		$biblio     = $biblioQ->doQuery( $bibid = 0 );
		$biblioFlds = $biblio->getBiblioFields();
	}
} else {
	require_once( "../shared/header.php" );
}

?>

<?php echo $msg ?>
<div class="row">
    <div class="col s12 m6">
        <h5><?php echo $loc->getText( "biblioViewTble1Hdr" ); ?></h5>

        <table>
            <tr>
                <td>
					<?php echo $loc->getText( "biblioViewMaterialType" ); ?>:
                </td>
                <td>
					<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php echo $loc->getText( "biblioViewCollection" ); ?>:
                </td>
                <td>
					<?php echo H( $collectionDm[ $biblio->getCollectionCd() ] ); ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php echo $loc->getText( "biblioViewCallNmbr" ); ?>:
                </td>
                <td>
                    <?php echo H($biblio->getCallNmbr1()); ?><br>
                    <?php echo H($biblio->getCallNmbr2()); ?><br>
					<?php echo H( $biblio->getCallNmbr3() ); ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php printUsmarcText( 245, "a", $marcTags, $marcSubflds, false ); ?>:
                </td>
                <td>
					<?php if ( isset( $biblioFlds["245a"] ) ) {
						echo H( $biblioFlds["245a"]->getFieldData() );
					} ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php printUsmarcText( 245, "b", $marcTags, $marcSubflds, false ); ?>:
                </td>
                <td>
					<?php if ( isset( $biblioFlds["245b"] ) ) {
						echo H( $biblioFlds["245b"]->getFieldData() );
					} ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php printUsmarcText( 100, "a", $marcTags, $marcSubflds, false ); ?>:
                </td>
                <td>
					<?php if ( isset( $biblioFlds["100a"] ) ) {
						echo H( $biblioFlds["100a"]->getFieldData() );
					} ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php printUsmarcText( 245, "c", $marcTags, $marcSubflds, false ); ?>:
                </td>
                <td>
					<?php if ( isset( $biblioFlds["245c"] ) ) {
						echo H( $biblioFlds["245c"]->getFieldData() );
					} ?>
                </td>
            </tr>
            <tr>
                <td>
					<?php echo $loc->getText( "biblioViewOpacFlg" ); ?>:
                </td>
                <td>
					<?php if ( $biblio->showInOpac() ) {
						echo $loc->getText( "biblioViewYes" );
					} else {
						echo $loc->getText( "biblioViewNo" );
					} ?>
                </td>
            </tr>


			<?php
			#****************************************************************************
			#*  Show picture of the Bibliography if defined
			#****************************************************************************
			if ( isset( $biblioFlds["902a"] ) ) {
				?>

                <tr>
                    <td>
						<?php printUsmarcText( 902, "a", $marcTags, $marcSubflds, false ); ?>:
                    </td>
                    <td>
                        <img src="../pictures/<?php echo $biblioFlds["902a"]->getFieldData(); ?>" width="150">
                    </td>
                </tr>

				<?php
			}
			?>
        </table>
    </div>

    <div class="col s12 m6">
        <h5><?php echo $loc->getText( "biblioViewTble3Hdr" ); ?></h5>

        <table>
			<?php
			$displayCount = 0;
			foreach ( $biblioFlds as $key => $field ) {
				if ( ( $field->getFieldData() != "" )
				     && ( $key != "245a" )
				     && ( $key != "245b" )
				     && ( $key != "245c" )
				     && ( $key != "902a" )
				     && ( $key != "100a" ) ) {
					$displayCount = $displayCount + 1;
					?>
                    <tr>
                        <td>
							<?php printUsmarcText( $field->getTag(), $field->getSubfieldCd(),
								$marcTags, $marcSubflds, false ); ?>:
                        </td>
                        <td>
							<?php echo H( $field->getFieldData() ); ?>
                        </td>
                    </tr>
					<?php
				}
			}
			if ( $displayCount == 0 ) {
				?>
                <tr>
                    <td>
						<?php echo $loc->getText( "biblioViewNoAddInfo" ); ?>
                    </td>
                </tr>
				<?php
			}
			?>
        </table>
    </div>
</div>

<h5>
	<?php echo $loc->getText( "biblioViewTble2Hdr" ); ?>
</h5>

<?php

#****************************************************************************
#*  Show copy information
#****************************************************************************
if ( $tab == "cataloging" ) { ?>
    <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y"
       class="waves-effect waves-light btn green">
        <i class="material-icons left">add</i>
		<?php echo $loc->getText( "biblioViewNewCopy" ); ?>
    </a>
	<?php
	$copyCols = 7;
} else {
	$copyCols = 5;
}

$copyQ = new BiblioCopyQuery();
$copyQ->connect();
if ( $copyQ->errorOccurred() ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
if ( ! $copy = $copyQ->execSelect( $bibid ) ) {
	$copyQ->close();
	displayErrorPage( $copyQ );
}
?>


<table class="primary">
    <tr>
	    <?php if ( $tab == "cataloging" ) { ?>
            <th colspan="2" nowrap="yes">
	            <?php echo $loc->getText( "biblioViewTble2ColFunc" ); ?>
            </th>
	    <?php } ?>
        <th align="left" nowrap="yes">
	        <?php echo $loc->getText( "biblioViewTble2Col1" ); ?>
        </th>
        <th align="left" nowrap="yes">
	        <?php echo $loc->getText( "biblioViewTble2Col2" ); ?>
        </th>
        <!-- Show header for copy fields -->
	    <?php
	    $dmQ = new DmQuery();
	    $dmQ->connect();
	    $customFields = $dmQ->getAssoc( 'biblio_copy_fields_dm' );
	    $dmQ->close();
	    foreach ( $customFields as $name => $title ) {
		    echo '<th align="left" nowrap="yes">' . H( $title ) . ':</th>';
	    }
	    ?>

        <th align="left" nowrap="yes">
	        <?php echo $loc->getText( "biblioViewTble2Col3" ); ?>
        </th>
        <th align="left" nowrap="yes">
	        <?php echo $loc->getText( "biblioViewTble2Col4" ); ?>
        </th>
        <th align="left" nowrap="yes">
	        <?php echo $loc->getText( "biblioViewTble2Col5" ); ?>
        </th>
    </tr>
	<?php
	if ( $copyQ->getRowCount() == 0 ) { ?>
        <tr>
            <td valign="top" colspan="<?php echo H( $copyCols ); ?>" class="primary" colspan="2">
		        <?php echo $loc->getText( "biblioViewNoCopies" ); ?>
            </td>
        </tr>
	<?php } else {
		$row_class = "primary";
		while ( $copy = $copyQ->fetchCopy() ) {
			?>
            <tr>
	            <?php if ( $tab == "cataloging" ) { ?>
                    <td valign="top" class="<?php echo H( $row_class ); ?>">
                        <a href="../catalog/biblio_copy_edit_form.php?bibid=<?php echo HURL( $copy->getBibid() ); ?>&amp;copyid=<?php echo H( $copy->getCopyid() ); ?>"
                           class="waves-effect waves-light btn green">
                            <i class="material-icons center">edit</i>
				            <?php //echo $loc->getText( "biblioViewTble2Coledit" ); ?>
                        </a>
                    </td>
                    <td valign="top" class="<?php echo H( $row_class ); ?>">
                        <a href="../catalog/biblio_copy_del_confirm.php?bibid=<?php echo HURL( $copy->getBibid() ); ?>&amp;copyid=<?php echo HURL( $copy->getCopyid() ); ?>"
                           class="waves-effect waves-light btn red">
                            <i class="material-icons center">delete</i>
				            <?php //echo $loc->getText( "biblioViewTble2Coldel" ); ?>
                        </a>
                    </td>
	            <?php } ?>
                <td valign="top" class="<?php echo H( $row_class ); ?>">
		            <?php echo H( $copy->getBarcodeNmbr() ); ?>
                </td>
                <td valign="top" class="<?php echo H( $row_class ); ?>">
		            <?php echo H( $copy->getCopyDesc() ); ?>
                </td>
	            <?php
	            // Show custom copy fields
	            foreach ( $customFields as $name => $title ) {
		            ?>
                    <td valign="top" class="<?php echo H( $row_class ); ?>">
			            <?php
			            echo H( $copy->getCustom( $name ) );
			            ?>
                    </td>
		            <?php
	            }
	            ?>
                <td valign="top" class="<?php echo H( $row_class ); ?>">
		            <?php echo H( $biblioStatusDm[ $copy->getStatusCd() ] ); ?>
                </td>
                <td valign="top" class="<?php echo H( $row_class ); ?>">
		            <?php echo H( $copy->getStatusBeginDt() ); ?>
                </td>
                <td valign="top" class="<?php echo H( $row_class ); ?>">
		            <?php echo H( $copy->getDueBackDt() ); ?>
                </td>
            </tr>
			<?php
			# swap row color
			if ( $row_class == "primary" ) {
				$row_class = "alt1";
			} else {
				$row_class = "primary";
			}
		}
		$copyQ->close();
	} ?>
</table>


<?php require_once( "../shared/footer.php" ); ?>
