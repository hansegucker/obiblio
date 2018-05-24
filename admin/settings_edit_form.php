<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
session_cache_limiter( null );

$tab              = "admin";
$nav              = "settings";
$focus_form_name  = "editsettingsform";
$focus_form_field = "libraryName";

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../shared/header.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Checking for query string flag to read data from database.
#****************************************************************************
if ( isset( $_GET["reset"] ) ) {
	unset( $_SESSION["postVars"] );
	unset( $_SESSION["pageErrors"] );

	include_once( "../classes/Settings.php" );
	include_once( "../classes/SettingsQuery.php" );
	include_once( "../functions/errorFuncs.php" );
	$setQ = new SettingsQuery();
	$setQ->connect();
	if ( $setQ->errorOccurred() ) {
		$setQ->close();
		displayErrorPage( $setQ );
	}
	$setQ->execSelect();
	if ( $setQ->errorOccurred() ) {
		$setQ->close();
		displayErrorPage( $setQ );
	}
	$set                         = $setQ->fetchRow();
	$postVars["libraryName"]     = $set->getLibraryName();
	$postVars["libraryImageUrl"] = $set->getLibraryImageUrl();
	if ( $set->isUseImageSet() ) {
		$postVars["isUseImageSet"] = "CHECKED";
	} else {
		$postVars["isUseImageSet"] = "";
	}
	$postVars["libraryHours"]            = $set->getLibraryHours();
	$postVars["libraryPhone"]            = $set->getLibraryPhone();
	$postVars["libraryUrl"]              = $set->getLibraryUrl();
	$postVars["opacUrl"]                 = $set->getOpacUrl();
	$postVars["sessionTimeout"]          = $set->getSessionTimeout();
	$postVars["itemsPerPage"]            = $set->getItemsPerPage();
	$postVars["purgeHistoryAfterMonths"] = $set->getPurgeHistoryAfterMonths();
	if ( $set->isBlockCheckoutsWhenFinesDue() ) {
		$postVars["isBlockCheckoutsWhenFinesDue"] = "CHECKED";
	} else {
		$postVars["isBlockCheckoutsWhenFinesDue"] = "";
	}
	$postVars["holdMaxDays"]  = $set->getHoldMaxDays();
	$postVars["locale"]       = $set->getLocale();
	$postVars["charset"]      = $set->getCharset();
	$postVars["htmlLangAttr"] = $set->getHtmlLangAttr();
	$setQ->close();
} else {
	require( "../shared/get_form_vars.php" );
}

#****************************************************************************
#*  Display update message if coming from settings_edit with a successful update.
#****************************************************************************
if ( isset( $_GET["updated"] ) ) {
	?>
    <p class="red-text"><?php echo $loc->getText( "admin_settingsUpdated" ); ?></p>
	<?php
}
?>

<form name="editsettingsform" method="POST" action="../admin/settings_edit.php">
    <input type="hidden" name="code" value="<?php echo H( $postVars["code"] ); ?>">

    <h3>
		<?php echo $loc->getText( "admin_settingsEditsettings" ); ?>
    </h3>

    <div class="input-field">
        <label for="libraryName">
			<?php echo $loc->getText( "admin_settingsLibName" ); ?>
        </label>

		<?php printInputText( "libraryName", 40, 128, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="libraryImageUrl">
			<?php echo $loc->getText( "admin_settingsLibimageurl" ); ?>
        </label>

		<?php printInputText( "libraryImageUrl", 40, 300, $postVars, $pageErrors ); ?>
    </div>

    <p>
        <label>
            <input type="checkbox" class="filled-in" name="isUseImageSet" value="CHECKED"
				<?php if ( isset( $postVars["isUseImageSet"] ) ) {
					echo H( $postVars["isUseImageSet"] );
				} ?> >
            <span><?php echo $loc->getText( "admin_settingsOnlyshowimginheader" ); ?></span>
        </label>
    </p>

    <div class="input-field">
        <label for="libraryHours">
			<?php echo $loc->getText( "admin_settingsLibhours" ); ?>
        </label>

		<?php printInputText( "libraryHours", 40, 128, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="libraryPhone">
			<?php echo $loc->getText( "admin_settingsLibphone" ); ?>
        </label>

		<?php printInputText( "libraryPhone", 40, 40, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="libraryUrl">
			<?php echo $loc->getText( "admin_settingsLibURL" ); ?>
        </label>

		<?php printInputText( "libraryUrl", 40, 300, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="opacUrl">
			<?php echo $loc->getText( "admin_settingsOPACURL" ); ?>
        </label>

		<?php printInputText( "opacUrl", 40, 300, $postVars, $pageErrors ); ?>
    </div>
    <div class="input-field row">
        <label for="sessionTimeout">
			<?php echo $loc->getText( "admin_settingsSessionTimeout" ); ?>
        </label>

		<?php printInputText( "sessionTimeout", 3, 3, $postVars, $pageErrors ); ?>
    </div>

    <div class="input-field">
        <label for="itemsPerPage">
			<?php echo $loc->getText( "admin_settingsSearchResults" ); ?>
        </label>

		<?php printInputText( "itemsPerPage", 2, 2, $postVars, $pageErrors ); ?>
    </div>

    <!--    --><?php //echo $loc->getText( "admin_settingsItemsperpage" ); ?>
    <div class="input-field">
        <label for="purgeHistoryAfterMonths">
            <sup>*</sup> <?php echo $loc->getText( "admin_settingsPurgebibhistory" ); ?>
        </label>

		<?php printInputText( "purgeHistoryAfterMonths", 2, 2, $postVars, $pageErrors ); ?>
    </div>
    <!--    --><?php //echo $loc->getText( "admin_settingsmonths" ); ?>

    <p>
        <label>
            <input type="checkbox" class="filled-in" name="isBlockCheckoutsWhenFinesDue" value="CHECKED"
				<?php if ( isset( $postVars["isBlockCheckoutsWhenFinesDue"] ) ) {
					echo H( $postVars["isBlockCheckoutsWhenFinesDue"] );
				} ?> >

            <span><?php echo $loc->getText( "admin_settingsBlockCheckouts" ); ?></span>
        </label>
    </p>

    <div class="input-field">
        <label for="holdMaxDays">
			<?php echo $loc->getText( "Max. hold length:" ); ?>
        </label>

		<?php printInputText( "holdMaxDays", 2, 2, $postVars, $pageErrors ); ?>
    </div>
    <!--    --><?php //echo $loc->getText( "days" ); ?>

    <p>
		<?php echo $loc->getText( "admin_settingsLocale" ); ?>

        <select name="locale">
			<?php
			$stng     = new Settings();
			$arr_lang = $stng->getLocales();
			foreach ( $arr_lang as $langCode => $langDesc ) {
				echo "<option value=\"" . H( $langCode ) . "\"";
				if ( $langCode == $postVars["locale"] ) {
					echo " selected";
				}
				echo ">" . H( $langDesc ) . "</option>\n";
			}
			?>
        </select>
    </p>

    <!--<tr>
            <td nowrap="true" class="primary">
                <?php echo $loc->getText( "admin_settingsHTMLChar" ); ?>
            </td>
            <td valign="top" class="primary">
                <?php printInputText( "charset", 20, 20, $postVars, $pageErrors ); ?>
            </td>
        </tr>-->

    <div class="input-field">
        <label for="htmlLangAttr">
			<?php echo $loc->getText( "admin_settingsHTMLTagLangAttr" ); ?>
        </label>

		<?php printInputText( "htmlLangAttr", 8, 8, $postVars, $pageErrors ); ?>
    </div>


    <button type="submit" class="waves-effect waves-light btn green">
        <i class="material-icons left">save</i>
		<?php echo $loc->getText( "adminUpdate" ); ?>
    </button>

</form>

<p>
	<?php echo $loc->getText( "adminCollections_edit_formNote" ); ?>
	<?php echo $loc->getText( "If the month value for purging history is higher than zero, values in statistics reports shift over time.<br>Data from statistics reports should be saved outside OpenBiblio for future reference." ); ?>
</p>


<?php include( "../shared/footer.php" ); ?>
