<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../classes/Localize.php");
$navloc = new Localize(OBIB_LOCALE, "navbars");

?>


<?php if ($nav == "searchform") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">search</i>
            &raquo; <?php echo $navloc->getText("memberSearch"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/index.php">
            <i class="material-icons">search</i>
            <?php echo $navloc->getText("memberSearch"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "search") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">search</i>
            &nbsp; &raquo; <?php echo $navloc->getText("catalogResults"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "view") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">information</i>
            &nbsp; &raquo; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">delete</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            <i class="material-icons">local_atm</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">history</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "edit") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">information</i>
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">delete</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            <i class="material-icons">local_atm</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">history</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "delete") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">information</i>
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">delete</i>
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            <i class="material-icons">local_atm</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">history</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "hist") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">information</i>
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">delete</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            <i class="material-icons">local_atm</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">history</i>
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "account") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">information</i>
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">delete</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">local_atm</i>
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            <i class="material-icons">history</i>
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "new") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">add</i>
            &raquo; <?php echo $navloc->getText("newMember"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/mbr_new_form.php?reset=Y">
            <i class="material-icons">add</i>
            <?php echo $navloc->getText("newMember"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "checkin") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">arrow_back</i>
            &raquo; <?php echo $navloc->getText("checkIn"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/checkin_form.php?reset=Y">
            <i class="material-icons">arrow_back</i>
            <?php echo $navloc->getText("checkIn"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "offline") { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">cloud_off</i>
            &raquo; <?php echo $navloc->getText("Offline Circulation"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/offline.php">
            <i class="material-icons">cloud_off</i>
            <?php echo $navloc->getText("Offline Circulation"); ?>
        </a>
    </li>
<?php } ?>

<li>
    <a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=" . H(addslashes(U($helpPage))); ?>')">
        <i class="material-icons">help</i>
        <?php echo $navloc->getText("help"); ?>
    </a>
</li>
