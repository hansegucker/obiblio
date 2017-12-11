<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../shared/common.php");

$temp_return_page = "";
if (isset($_GET["RET"])) {
    if (in_array($_GET["RET"], $pages, true)) {
        $_SESSION["returnPage"] = $_GET["RET"];
    } else {
        $_SESSION["returnPage"] = '../home/index.php';
    }
}

$tab = "home";
$nav = "";
$focus_form_name = "loginform";
$focus_form_field = "username";

require_once("../shared/get_form_vars.php");
require_once("../shared/header.php");
require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE, "shared");

?>

<div class="row">
    <div class="col s0 m3">

    </div>
    <form name="loginform" method="POST" action="../shared/login.php" class="col s12 m6">
        <h3><?php echo $loc->getText("loginFormTbleHdr"); ?></h3>

        <div class="input-field">
            <input type="text" id="username" name="username" size="20" maxlength="20" class="validate"
                   value="<?php if (isset($postVars["username"])) echo H($postVars["username"]); ?>">
            <label for="username"><?php echo $loc->getText("loginFormUsername"); ?></label>

            <span class="red-text">
                <?php if (isset($pageErrors["username"])) echo H($pageErrors["username"]); ?>
            </span>
        </div>


        <div class="input-field">
            <input type="password" id="pwd" name="pwd" size="20" maxlength="20" class="validate"
                   value="<?php if (isset($postVars["pwd"])) echo H($postVars["pwd"]); ?>">
            <label for="pwd"><?php echo $loc->getText("loginFormPassword"); ?></label>

            <span class="red-text">
                <?php if (isset($pageErrors["pwd"])) echo H($pageErrors["pwd"]); ?>
            </span>
        </div>

        <button type="submit" class="waves-effect waves-light btn col s12 green">
            <?php echo $loc->getText("loginFormLogin"); ?>
        </button>
    </form>
    <div class="col s0 m3">

    </div>
</div>


<?php include("../shared/footer.php"); ?>
