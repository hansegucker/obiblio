<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once("../classes/Localize.php");
$navloc = new Localize(OBIB_LOCALE, "navbars");

?>
<li>
    <a class="waves-effect waves-light btn red" href="../shared/logout.php">
        <?php echo $navloc->getText("logout"); ?>
    </a>
</li>

<?php if ($nav == "searchform") { ?>
    <li>
        <a href="#" class="disabled">
            &raquo; <?php echo $navloc->getText("memberSearch"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/index.php">
            <?php echo $navloc->getText("memberSearch"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "search") { ?>
    <li>
        <a href="#" class="disabled">
            &nbsp; &raquo; <?php echo $navloc->getText("catalogResults"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "view") { ?>
    <li>
        <a href="#" class="disabled">
            &nbsp; &raquo; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "edit") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "delete") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">&nbsp; &nbsp; &raquo; <?php echo $navloc->getText("catalogDelete"); ?></a></li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "hist") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_account.php?mbrid=<?php echo HURL($mbrid); ?>&amp;reset=Y">
            &nbsp; &nbsp; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "account") { ?>
    <li>
        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; <?php echo $navloc->getText("memberInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_edit_form.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("editInfo"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_del_confirm.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("catalogDelete"); ?>
        </a>
    </li>
    <li>
        <a href="#" class="disabled">
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText("account"); ?>
        </a>
    </li>
    <li>
        <a href="../circ/mbr_history.php?mbrid=<?php echo HURL($mbrid); ?>">
            &nbsp; &nbsp; <?php echo $navloc->getText("checkoutHistory"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "new") { ?>
    <li>
        <a href="#" class="disabled">
            &raquo; <?php echo $navloc->getText("newMember"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/mbr_new_form.php?reset=Y" class="alt1">
            <?php echo $navloc->getText("newMember"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "checkin") { ?>
    <li>
        <a href="#" class="disabled">
            &raquo; <?php echo $navloc->getText("checkIn"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/checkin_form.php?reset=Y" class="alt1">
            <?php echo $navloc->getText("checkIn"); ?>
        </a>
    </li>
<?php } ?>

<?php if ($nav == "offline") { ?>
    <li>
        <a href="#" class="disabled">
            &raquo; <?php echo $navloc->getText("Offline Circulation"); ?>
        </a>
    </li>
<?php } else { ?>
    <li>
        <a href="../circ/offline.php">
            <?php echo $navloc->getText("Offline Circulation"); ?>
        </a>
    </li>
<?php } ?>

<li>
    <a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=" . H(addslashes(U($helpPage))); ?>')">
        <?php echo $navloc->getText("help"); ?>
    </a>
</li>
