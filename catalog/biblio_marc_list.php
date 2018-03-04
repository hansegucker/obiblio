<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab = "cataloging";
$nav = "editmarc";
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioField.php" );
require_once( "../classes/BiblioFieldQuery.php" );
require_once( "../classes/UsmarcTagDm.php" );
require_once( "../classes/UsmarcTagDmQuery.php" );
require_once( "../classes/UsmarcSubfieldDm.php" );
require_once( "../classes/UsmarcSubfieldDmQuery.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$bibid = $_GET["bibid"];
if ( isset( $_GET["msg"] ) ) {
	$msg = "<p class=\"red-text\">" . H( $_GET["msg"] ) . "</p>";
} else {
	$msg = "";
}
require_once( "../shared/header.php" );

#****************************************************************************
#*  Loading up an array ($marcArray) with the USMarc tag descriptions.
#****************************************************************************
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
#*  Execute query
#****************************************************************************
$fieldQ = new BiblioFieldQuery();
$fieldQ->connect();
if ( $fieldQ->errorOccurred() ) {
	$fieldQ->close();
	displayErrorPage( $fieldQ );
}
$fieldQ->execSelect( $bibid );
if ( $fieldQ->errorOccurred() ) {
	$fieldQ->close();
	displayErrorPage( $fieldQ );
}

function getDescription( &$dm, $key ) {
	if ( array_key_exists( $key, $dm ) ) {
		return $dm[ $key ]->getDescription();
	} else {
		return '';
	}
}

#****************************************************************************
#*  Start of body
#****************************************************************************
?>


<!--
 ****************************************************************************
 *  Table header
 ****************************************************************************
-->
<h5><?php echo $loc->getText( "biblioMarcListHdr" ); ?></h5>

<a href="../catalog/biblio_marc_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y"
   class="waves-effect waves-light btn green">
    <i class="material-icons left">add</i>
	<?php echo $loc->getText( "biblioMarcListMarcSelect" ); ?>
</a>

<?php echo $msg ?>

<table>
    <tr>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol1" ); ?>
        </th>
        <th></th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol2" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol3" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol4" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol5" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol6" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol7" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "biblioMarcListTbleCol8" ); ?>
        </th>
    </tr>

	<?php
	#****************************************************************************
	#*  Display USMarc data
	#****************************************************************************
	if ( $fieldQ->getRowCount() == 0 ) {
		?>
        <tr>
            <td>
		        <?php echo $loc->getText( "biblioMarcListNoRows" ); ?>
            </td>
        </tr>
		<?php
	} else {
		$row_class = "primary";
		while ( $fld = $fieldQ->fetchField() ) {
			$tag         = sprintf( "%03d", $fld->getTag() );
			$subfldIndex = $tag . $fld->getSubfieldCd();
			?>
            <tr>
                <td>
                    <a href="../catalog/biblio_marc_edit_form.php?bibid=<?php
		            echo HURL( $bibid ); ?>&amp;fieldid=<?php echo HURL( $fld->getFieldid() ); ?>&amp;reset=Y"
                       class="waves-effect waves-light btn green">
                        <i class="material-icons center">edit</i>
                        <!--                        --><?php //echo $loc->getText( "biblioMarcListEdit" ); ?>
                    </a>
                </td>
                <td>
                    <a href="../catalog/biblio_marc_del_confirm.php?bibid=<?php
		            echo HURL( $bibid ); ?>&amp;fieldid=<?php echo H( $fld->getFieldid() ); ?>&amp;tag=<?php
		            echo HURL( $tag ); ?>&amp;subfieldCd=<?php echo HURL( $fld->getSubfieldCd() ); ?>"
                       class="waves-effect waves-light btn red">
                        <i class="material-icons center">delete</i>
                        <!--                        --><?php //echo $loc->getText( "biblioMarcListDel" ); ?>
                    </a>
                </td>
                <td>
		            <?php echo H( $tag ); ?>
                </td>
                <td>
		            <?php echo H( getDescription( $marcTags, $fld->getTag() ) ); ?>
                </td>
                <td>
		            <?php echo H( $fld->getInd1Cd() ); ?>
                </td>
                <td>
		            <?php echo H( $fld->getInd2Cd() ); ?>
                </td>
                <td>
		            <?php echo H( $fld->getSubfieldCd() ); ?>
                </td>
                <td>
		            <?php echo H( getDescription( $marcSubflds, $subfldIndex ) ); ?>
                </td>
                <td>
		            <?php echo H( $fld->getFieldData() ); ?>
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
	}
	$fieldQ->close();
	?>
</table>

<?php include( "../shared/footer.php" ); ?>
