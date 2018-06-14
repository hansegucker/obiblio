<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../classes/Localize.php" );
$navLoc = new Localize( OBIB_LOCALE, "navbars" );

?>
<?php if ( $nav == "summary" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">home</i>
            &raquo; <?php echo $navLoc->getText( "adminSummary" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/index.php">
            <i class="material-icons">home</i>
			<?php echo $navLoc->getText( "adminSummary" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "staff" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">people</i>
            &raquo; <?php echo $navLoc->getText( "adminStaff" ); ?>
        </a>
    </li>

<?php } else { ?>
    <li>
        <a href="../admin/staff_list.php">
            <i class="material-icons">people</i>
			<?php echo $navLoc->getText( "adminStaff" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "settings" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">settings</i>
            &raquo; <?php echo $navLoc->getText( "adminSettings" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/settings_edit_form.php?reset=Y">
            <i class="material-icons">settings</i>
			<?php echo $navLoc->getText( "adminSettings" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "classifications" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">accessibility</i>
            &raquo; <?php echo $navLoc->getText( "Member Types" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/mbr_classify_list.php">
            <i class="material-icons">accessibility</i>
			<?php echo $navLoc->getText( "Member Types" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "member_fields" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">face</i>
            &raquo; <?php echo $navLoc->getText( "Member Fields" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/member_fields_list.php">
            <i class="material-icons">face</i>
			<?php echo $navLoc->getText( "Member Fields" ); ?>
        </a>
<li>
	<?php } ?>

	<?php if ( $nav == "copy_fields" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">important_devices</i>
            &raquo; <?php echo $navLoc->getText( "Copy Fields" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/copy_fields_list.php">
            <i class="material-icons">important_devices</i>
			<?php echo $navLoc->getText( "Copy Fields" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "materials" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">devices</i>
            &raquo; <?php echo $navLoc->getText( "adminMaterialTypes" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/materials_list.php">
            <i class="material-icons">devices</i>
			<?php echo $navLoc->getText( "adminMaterialTypes" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "collections" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">library_books</i>
            &raquo; <?php echo $navLoc->getText( "adminCollections" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/collections_list.php">
            <i class="material-icons">library_books</i>
			<?php echo $navLoc->getText( "adminCollections" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "checkout_privs" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">settings</i>
            &raquo; <?php echo $navLoc->getText( "Checkout Privs" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/checkout_privs_list.php">
            <i class="material-icons">settings</i>
			<?php echo $navLoc->getText( "Checkout Privs" ); ?>
        </a>
    </li>
<?php } ?>

<?php if ( $nav == "themes" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">invert_colors</i>
            &raquo; <?php echo $navLoc->getText( "adminThemes" ); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../admin/theme_list.php">
            <i class="material-icons">invert_colors</i>
			<?php echo $navLoc->getText( "adminThemes" ); ?>
        </a>
    </li>
<?php } ?>

<!--
< ?php if ($nav == "translation") { ?>
 &raquo; < ?php echo $navLoc->getText("adminTranslation");?><br>
< ?php } else { ?>
 <a href="../admin/translation_list.php" class="alt1">< ?php echo $navLoc->getText("adminTranslation");?></a><br>
< ?php } ?>
-->
