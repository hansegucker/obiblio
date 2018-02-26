<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../classes/DmQuery.php" );
require_once( "../classes/UsmarcTagDm.php" );
require_once( "../classes/UsmarcTagDmQuery.php" );
require_once( "../classes/UsmarcSubfieldDm.php" );
require_once( "../classes/UsmarcSubfieldDmQuery.php" );
require_once( "../functions/errorFuncs.php" );
require_once( "../functions/inputFuncs.php" );
require_once( "../catalog/inputFuncs.php" );

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

?>

<input type="hidden" name="posted" value="1"/>

<p>
	<?php echo $loc->getText( "catalogFootnote", array( "symbol" => "*" ) ); ?>
</p>

<h5>
	<?php
	echo H( $headerWording ) . " ";
	echo $loc->getText( "biblioFieldsLabel" );
	?>
</h5>

<div class="input-field">
    <sup>*</sup> <?php echo $loc->getText( "biblioFieldsMaterialTyp" ); ?>

	<?php
	//    Played with printselect function
	if ( isset( $postVars['materialCd'] ) ) {
		$materialCd = $postVars['materialCd'];
	} else {
		$materialCd = '';
	}
	$fieldname   = "materialCd";
	$domainTable = "material_type_dm";

	$dmQ = new DmQuery();
	$dmQ->connect();
	$dms = $dmQ->get( $domainTable );
	$dmQ->close();
	echo "<select id=\"materialCd\" name=\"materialCd\"";

	//    Needed OnChange event here.
	echo " onChange=\"matCdReload()\">\n";
	foreach ( $dms as $dm ) {
		echo "<option value=\"" . H( $dm->getCode() ) . "\"";
		if ( ( $materialCd == "" ) && ( $dm->getDefaultFlg() == 'Y' ) ) {
			$materialCd = $dm->getCode();
			echo " selected";
		} elseif ( $materialCd == $dm->getCode() ) {
			echo " selected";
		}
		echo ">" . H( $dm->getDescription() ) . "</option>\n";
	}
	echo "</select>\n";
	?>
</div>

<div class="input-field">
    <sup>*</sup> <?php echo $loc->getText( "biblioFieldsCollection" ); ?>

	<?php printSelect( "collectionCd", "collection_dm", $postVars ); ?>
</div>

<div class="input-field">
    <sup>*</sup> <?php echo $loc->getText( "biblioFieldsCallNmbr" ); ?>

	<?php printInputText( "callNmbr1", 20, 20, $postVars, $pageErrors ); ?><br>
	<?php printInputText( "callNmbr2", 20, 20, $postVars, $pageErrors ); ?><br>
	<?php printInputText( "callNmbr3", 20, 20, $postVars, $pageErrors ); ?>
</div>

<label>
    <input type="checkbox" name="opacFlg" value="CHECKED" class="filled-in"
		<?php if ( isset( $postVars["opacFlg"] ) ) {
			echo H( $postVars["opacFlg"] );
		} ?> >
    <span>
        <?php echo $loc->getText( "biblioFieldsOpacFlg" ); ?>
    </span>
</label>


<h5><?php echo $loc->getText( "biblioFieldsUsmarcFields" ); ?></h5>

<?php printUsmarcInputText( 245, "a", true, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 245, "b", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 490, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 245, "c", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 100, "a", true, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 650, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 650, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL, "1" ); ?>
<?php printUsmarcInputText( 650, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL, "2" ); ?>
<?php printUsmarcInputText( 650, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL, "3" ); ?>
<?php printUsmarcInputText( 650, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL, "4" ); ?>
<?php printUsmarcInputText( 250, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 20, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 22, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php #printUsmarcInputText(10,"a",FALSE,$postVars,$pageErrors,$marcTags, $marcSubflds, FALSE,OBIB_TEXT_CNTRL);?>
<?php #printUsmarcInputText(50,"a",FALSE,$postVars,$pageErrors,$marcTags, $marcSubflds, TRUE,OBIB_TEXT_CNTRL);?>
<?php #printUsmarcInputText(50,"b",FALSE,$postVars,$pageErrors,$marcTags, $marcSubflds, TRUE,OBIB_TEXT_CNTRL);?>
<?php #printUsmarcInputText(82,"a",FALSE,$postVars,$pageErrors,$marcTags, $marcSubflds, TRUE,OBIB_TEXT_CNTRL);?>
<?php #printUsmarcInputText(82,"2",FALSE,$postVars,$pageErrors,$marcTags, $marcSubflds, TRUE,OBIB_TEXT_CNTRL);?>
<?php printUsmarcInputText( 260, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 260, "b", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 260, "c", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 520, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXTAREA_CNTRL ); ?>
<?php printUsmarcInputText( 300, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, true, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 300, "b", false, $postVars, $pageErrors, $marcTags, $marcSubflds, true, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 300, "c", false, $postVars, $pageErrors, $marcTags, $marcSubflds, true, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 300, "e", false, $postVars, $pageErrors, $marcTags, $marcSubflds, true, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 20, "c", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 541, "h", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 901, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 901, "b", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 901, "c", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 901, "d", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 901, "e", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>
<?php printUsmarcInputText( 902, "a", false, $postVars, $pageErrors, $marcTags, $marcSubflds, false, OBIB_TEXT_CNTRL ); ?>

<?php include( "biblio_custom_fields.php" ); ?>


<button type="submit" class="waves-effect waves-light btn green">
    <i class="material-icons left">save</i>
	<?php echo $loc->getText( "catalogSubmit" ); ?>
</button>
<a href="<?php echo H( addslashes( $cancelLocation ) ); ?>" class="waves-effect waves-light btn red">
    <i class="material-icons left">cancel</i>
	<?php echo $loc->getText( "catalogCancel" ); ?>
</a>


<p><sup>(2)</sup> <?php echo $loc->getText( "PictDesc" ); ?></p>
