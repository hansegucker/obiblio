<!DOCTYPE html>

<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../classes/Localize.php" );
$headerLoc = new Localize( OBIB_LOCALE, "shared" );

// code character set in HTTP header if specified
if ( OBIB_CHARSET != "" ) {
	$content_type = 'text/html; charset=' . H( OBIB_CHARSET );
	header( "Content-Type: $content_type" );
}

// code html tag with language attribute if specified.
echo "<html";
if ( OBIB_HTML_LANG_ATTR != "" ) {
	echo " lang=\"" . H( OBIB_HTML_LANG_ATTR ) . "\"";
}
echo ">\n";
?>


<head>
	<?php
	// code character set in metadata if specified
	if ( OBIB_CHARSET != "" ) {
		echo "<meta charset=\"" . H( OBIB_CHARSET ) . "\">";
	} ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="OpenBiblio Library Automation System">
    <title><?php echo H( OBIB_LIBRARY_NAME ); ?></title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--<link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"
          media="screen,projection">-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.3/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!--<script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-alpha.3/js/materialize.min.js"></script>
    <script type="text/javascript">
        <!--
        $(document).ready(function () {
            // Init side nav
            $(".button-collapse").sidenav();
            $('select').select();
        });

        function popSecondary(url) {
            var SecondaryWin;
            SecondaryWin = window.open(url, "secondary", "resizable=yes,scrollbars=yes,width=535,height=400");
            self.name = "main";
        }

        function popSecondaryLarge(url) {
            var SecondaryWin;
            SecondaryWin = window.open(url, "secondary", "toolbar=yes,resizable=yes,scrollbars=yes,width=700,height=500");
            self.name = "main";
        }

        function backToMain(URL) {
            var mainWin;
            mainWin = window.open(URL, "main");
            mainWin.focus();
            this.close();
        }

        -->
    </script>


</head>
<body <?php
if ( isset( $focus_form_name ) && ( $focus_form_name != "" ) ) {
	if ( preg_match( '/^[a-zA-Z0-9_]+$/', $focus_form_name )
	     && preg_match( '/^[a-zA-Z0-9_]+$/', $focus_form_field ) ) {
		echo 'onLoad="self.focus();document.' . $focus_form_name . "." . $focus_form_field . '.focus()"';
	}
} ?> >
<header>
    <nav class="nav-extended">
        <div class="nav-wrapper">
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <!-- Logo and title -->
            <a href="#" class="brand-logo">
	            <?php
	            /*if ( OBIB_LIBRARY_IMAGE_URL != "" ) {
					echo "<img src=\"" . H( OBIB_LIBRARY_IMAGE_URL ) . "\">";
				}*/
	            if ( ! OBIB_LIBRARY_USE_IMAGE_ONLY ) {
		            echo " " . H( OBIB_LIBRARY_NAME );
	            }
	            ?>
            </a>

            <!-- Library information (date, hours, phone) -->
            <div class="right">
	            <?php echo $headerLoc->getText( "headerTodaysDate" ); ?>
	            <?php echo H( date( $headerLoc->getText( "headerDateFormat" ) ) ); ?><br>

	            <?php if ( OBIB_LIBRARY_HOURS != "" ) {
		            echo $headerLoc->getText( "headerLibraryHours" );
	            } ?>
	            <?php if ( OBIB_LIBRARY_HOURS != "" ) {
		            echo H( OBIB_LIBRARY_HOURS );
	            } ?>

	            <?php if ( OBIB_LIBRARY_PHONE != "" ) {
		            echo $headerLoc->getText( "headerLibraryPhone" );
	            } ?>
	            <?php if ( OBIB_LIBRARY_PHONE != "" ) {
		            echo H( OBIB_LIBRARY_PHONE );
	            } ?>
            </div>
        </div>

        <!-- Tab nav -->
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
	            <?php if ( $tab == "home" ) { ?>
                    <li class="tab"><a href="#" class="active"><?php echo $headerLoc->getText( "headerHome" ); ?></a>
                    </li>
	            <?php } else { ?>
                    <li class="tab"><a target="_self"
                                       href="../home/index.php"><?php echo $headerLoc->getText( "headerHome" ); ?></a>
                    </li>
	            <?php } ?>

	            <?php if ( $tab == "circulation" ) { ?>
                    <li class="tab"><a href="#"
                                       class="active"><?php echo $headerLoc->getText( "headerCirculation" ); ?></a>
                    </li>
	            <?php } else { ?>
                    <li class="tab"><a target="_self"
                                       href="../circ/index.php"><?php echo $headerLoc->getText( "headerCirculation" ); ?></a>
                    </li>
	            <?php } ?>

	            <?php if ( $tab == "cataloging" ) { ?>
                    <li class="tab"><a href="#"
                                       class="active"><?php echo $headerLoc->getText( "headerCataloging" ); ?></a>
                    </li>
	            <?php } else { ?>
                    <li class="tab"><a target="_self"
                                       href="../catalog/index.php"><?php echo $headerLoc->getText( "headerCataloging" ); ?></a>
                    </li>
	            <?php } ?>


	            <?php if ( $tab == "admin" ) { ?>
                    <li class="tab"><a href="#" class="active"><?php echo $headerLoc->getText( "headerAdmin" ); ?></a>
                    </li>
	            <?php } else { ?>
                    <li class="tab"><a target="_self"
                                       href="../admin/index.php"><?php echo $headerLoc->getText( "headerAdmin" ); ?></a>
                    </li>
	            <?php } ?>

	            <?php if ( $tab == "reports" ) { ?>
                    <li class="tab"><a href="#" class="active"><?php echo $headerLoc->getText( "headerReports" ); ?></a>
                    </li>
	            <?php } else { ?>
                    <li class="tab"><a target="_self"
                                       href="../reports/index.php"><?php echo $headerLoc->getText( "headerReports" ); ?></a>
                    </li>
	            <?php } ?>
            </ul>
        </div>
