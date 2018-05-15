<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
require_once("../classes/Localize.php");
$navLoc = new Localize(OBIB_LOCALE, "navbars");

if ( preg_match( '/[^a-zA-Z0-9_]/', $tab ) ) {
	Fatal::internalError( "Possible security violation: bad tab name" );
	exit(); # just in case
}

include( "../shared/header_top.php" );; ?>
<!-- **************************************************************************************
     * Left nav
     **************************************************************************************-->
<ul id="nav-mobile" class="sidenav sidenav-fixed">
    <li class="logo">
        <a id="logo-container" href="index.php" class="brand-logo">
			<?php
			if ( OBIB_LIBRARY_IMAGE_URL != "" ) {
				echo "<img src=\"" . H( OBIB_LIBRARY_IMAGE_URL ) . "\">";
			}
			?>
        </a>
    </li>
	<?php
	if (isset($_SESSION["userid"])) {
    $sess_userid = $_SESSION["userid"];
} else {
    $sess_userid = "";
}
if ($sess_userid == "") { ?>
    <li class="logout">
        <a class="waves-effect waves-light btn green" href="../shared/loginform.php?RET=../home/index.php">
            <?php echo $navLoc->getText("login"); ?>
        </a>
    </li>
<?php } else { ?>

    <li class="logout">
        <a class="waves-effect waves-light btn red" href="../shared/logout.php">
            <?php echo $navLoc->getText("logout"); ?>
        </a>
    </li>
	<li>
		<a class="disabled">
	<?php  
	unset($_SESSION["postVars"]);
    unset($_SESSION["pageErrors"]);

    $postVars["userid"] = $_SESSION['userid'];
	include_once("../classes/Staff.php");
    include_once("../classes/StaffQuery.php");
    include_once("../functions/errorFuncs.php");
    $staffQ = new StaffQuery();
    $staffQ->connect();
    if ($staffQ->errorOccurred()) {
        $staffQ->close();
        displayErrorPage($staffQ);
    }
    $staffQ->execSelect($postVars["userid"]);
    if ($staffQ->errorOccurred()) {
        $staffQ->close();
        displayErrorPage($staffQ);
    }
    $staff = $staffQ->fetchStaff();
    $postVars["last_name"] = $staff->getLastName();
    $postVars["first_name"] = $staff->getFirstName();
    $postVars["username"] = $staff->getUsername(); ?>
			Angemeldet als: <?php //echo $_SESSION['username'];
									echo $postVars["first_name"]." ".$postVars["last_name"];?>
		</a>
	</li>
<?php } ?>
	<?php include( "../navbars/" . $tab . ".php" ); ?>
</ul>
</nav>
</header>

<!-- **************************************************************************************
    * beginning of main body
    **************************************************************************************-->
<main>
