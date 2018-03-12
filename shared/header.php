<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

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
	<?php include( "../navbars/" . $tab . ".php" ); ?>
</ul>
</nav>
</header>

<!-- **************************************************************************************
    * beginning of main body
    **************************************************************************************-->
<main>
