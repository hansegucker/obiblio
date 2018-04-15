<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "cataloging";
$nav = "upload_usmarc";

include( "../shared/logincheck.php" );
include( "../shared/header.php" );

require_once( "../classes/UsmarcTagDm.php" );
require_once( "../classes/UsmarcTagDmQuery.php" );
require_once( "../classes/UsmarcSubfieldDm.php" );
require_once( "../classes/UsmarcSubfieldDmQuery.php" );
require_once( "../functions/errorFuncs.php" );
require_once( "../catalog/inputFuncs.php" );
require_once( "../functions/inputFuncs.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

?>

<form enctype="multipart/form-data" action="../catalog/upload_usmarc.php" method="post">
	<?php echo $loc->getText( "MarcUploadTest" ); ?>:
    <p>
        <label>
            <input type="radio" value="true" name="test" checked>
            <span><?php echo $loc->getText( "MarcUploadTestTrue" ); ?></span>
        </label><br>

        <label>
            <input type="radio" value="false" name="test">
            <span><?php echo $loc->getText( "MarcUploadTestFalse" ); ?></span>
        </label>
    </p>
	<?php echo $loc->getText( "MarcUploadTestFileUpload" ); ?>:
    <div class="file-field input-field">
        <div class="btn">
            <span><i class="material-icons">file_upload</i></span>
            <input type="file" name="usmarc_data">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>
    <!--    <input type="file" name="usmarc_data"><br><br>-->


    <h5>Defaults:</h5>
    <p>
		<?php echo $loc->getText( "biblioFieldsCollection" ); ?>:
		<?php printSelect( "collectionCd", "collection_dm", $postVars ); ?>
    </p>

    <p>
		<?php echo $loc->getText( "biblioFieldsMaterialTyp" ); ?>:
		<?php printSelect( "materialCd", "material_type_dm", $postVars ); ?>
    </p>

    <p>
		<?php echo $loc->getText( "biblioFieldsOpacFlg" ); ?>:
        <select name="opac" id="opac">
            <option value="Y" selected><?php echo $loc->getText( "AnswerYes" ); ?></option>
            <option value="N"><?php echo $loc->getText( "AnswerNo" ); ?></option>
        </select>
    </p>

    <input type=hidden name=userid id=userid value="<?php echo H( $_SESSION["userid"] ) ?>">

    <button type="submit" class="waves-effect waves-light btn green">
		<?php echo $loc->getText( "UploadFile" ); ?>
    </button>
</form>

<?php include( "../shared/footer.php" ); ?>
