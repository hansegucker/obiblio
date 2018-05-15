<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../classes/Localize.php" );
$navloc = new Localize( OBIB_LOCALE, "navbars" );

?>



<?php if ( $nav == "searchform" ) { ?>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">search</i> &raquo; <?php echo $navloc->getText( "catalogSearch1" ); ?>
        </a>
    </li>
<?php } else { ?>

    <li>
        <a href="../catalog/index.php">
            <i class="material-icons">search</i>
			<?php echo $navloc->getText( "catalogSearch2" ); ?>
        </a>
    </li>

<?php } ?>

<?php if ( $nav == "search" ) { ?>

    <li>
        <a href="#" class="disabled">
            <i class="material-icons">search</i> &nbsp; &raquo; <?php echo $navloc->getText( "catalogResults" ); ?>
        </a></li>

<?php } ?>

<?php if ( $nav == "view" ) { ?>

    <li>
        <a href="#" class="disabled">
            <i class="material-icons">info</i> &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>


    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>

<?php } ?>

<?php if ( $nav == "newcopy" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">add</i> &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "editcopy" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "catalogCopyEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "edit" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">edit</i> &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "editmarc" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">edit</i> &nbsp; &nbsp;
            &raquo; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y')">
            <i class="material-icons">add</i> &nbsp; &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibMarcNewFld" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "newmarc" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">add</i> &nbsp; &nbsp; &nbsp;
            &raquo; <?php echo $navloc->getText( "catalogBibMarcNewFld" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "editmarcfield" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">edit</i>
            &nbsp; &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "catalogBibMarcEditFld" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "history" ) { ?>
    <li>
        <a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li>
        <a href="#" class="disabled">
            <i class="material-icons">history</i> &nbsp; &nbsp; &raquo; <?php echo $navloc->getText( "History" ); ?>
        </a>
    </li>
    <li>
        <a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a>
    </li>
    <li>
        <a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a>
    </li>
    <li>
        <a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li>
        <a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "holds" ) { ?>
    <li><a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li><a href="#" class="disabled">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp;
            &raquo; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_del_confirm.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">delete</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "delete" ) { ?>
    <li><a href="../shared/biblio_view.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">info</i> &nbsp; <?php echo $navloc->getText( "catalogBibInfo" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_edit.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEdit" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">edit</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogBibEditMarc" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_history.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">history</i> &nbsp; &nbsp; <?php echo $navloc->getText( "History" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_copy_new_form.php?bibid=<?php echo HURL( $bibid ); ?>&reset=Y">
            <i class="material-icons">add</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogCopyNew" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_hold_list.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">bookmark</i> &nbsp; &nbsp; <?php echo $navloc->getText( "catalogHolds" ); ?>
        </a></li>
    <li><a href="#" class="disabled">
            <i class="material-icons">delete</i> &nbsp; &nbsp;
            &raquo; <?php echo $navloc->getText( "catalogDelete" ); ?>
        </a></li>
    <li><a href="../catalog/biblio_new_like.php?bibid=<?php echo HURL( $bibid ); ?>">
            <i class="material-icons">open_in_new</i> &nbsp;
            &nbsp; <?php echo $navloc->getText( "catalogBibNewLike" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "new" ) { ?>
    <li><a href="#" class="disabled">
            <i class="material-icons">add</i> &raquo; <?php echo $navloc->getText( "catalogBibNew" ); ?>
        </a></li>
<?php } else { ?>
    <li><a href="../catalog/biblio_new.php">
            <i class="material-icons">add</i>

			<?php echo $navloc->getText( "catalogBibNew" ); ?>
        </a></li>
<?php } ?>

<?php if ( $nav == "upload_usmarc" ) { ?>
    <li><a href="#" class="disabled">
            <i class="material-icons">file_upload</i> &raquo; <?php echo $navloc->getText( "Upload Marc Data" ); ?>
        </a></li>
<?php } else { ?>
    <li>
        <a href="../catalog/upload_usmarc_form.php">
            <i class="material-icons">file_upload</i>
			<?php echo $navloc->getText( "Upload Marc Data" ); ?>
        </a>
    </li>

<?php } ?>

<li>
    <a href="javascript:popSecondary('../shared/help.php<?php if ( isset( $helpPage ) ) {
		echo "?page=" . H( addslashes( U( $helpPage ) ) );
	} ?>')">
        <i class="material-icons">help</i>
		<?php echo $navloc->getText( "help" ); ?>
    </a>
</li>

