<h5><?php echo H( $formLabel ); ?></h5>

<div class="input-field">
    <label for="tag">
		<?php echo $loc->getText( "biblioMarcNewFormTag" ); ?>
    </label>
	<?php printInputText( "tag", 3, 3, $postVars, $pageErrors ); ?>
    <button onClick="popSecondary('../catalog/usmarc_select.php?retpage=<?php
	echo HURL( $returnPg ); ?>')"
            class="waves-effect waves-light btn green">
		<?php echo $loc->getText( "biblioMarcNewFormSelect" ); ?>
    </button>
</div>

<h6>
	<?php echo H( $tagDesc ); ?>
</h6>

<p>
    <label>
        <input type="checkbox" name="ind1Cd" class="filled-in" value="CHECKED"
			<?php if ( isset( $postVars["ind1Cd"] ) ) {
				echo H( $postVars["ind1Cd"] );
			} ?> >

        <span>
        <?php echo H( $ind1Desc ); ?> (<?php echo $loc->getText( "biblioMarcNewFormInd1" ); ?>)
    </span>
    </label>
</p>

<p>
    <label>
        <input type="checkbox" name="ind2Cd" class="filled-in" value="CHECKED"
			<?php if ( isset( $postVars["ind2Cd"] ) ) {
				echo H( $postVars["ind2Cd"] );
			} ?> >

        <span>
        <?php echo H( $ind2Desc ); ?> (<?php echo $loc->getText( "biblioMarcNewFormInd2" ); ?>)
    </span
    </label>
</p>

<div class="input-field">
    <label for="subfieldCd">
		<?php echo H( $subfldDesc ); ?>
        (<?php echo $loc->getText( "biblioMarcNewFormSubfld" ); ?>)
    </label>

	<?php printInputText( "subfieldCd", 1, 1, $postVars, $pageErrors ); ?>
</div>

<div class="input-field">
    <label for="fieldData">
		<?php echo $loc->getText( "biblioMarcNewFormData" ); ?>
    </label>

	<?php printInputText( "fieldData", 60, 256, $postVars, $pageErrors ); ?>
</div>

<button type="submit" class="waves-effect waves-light btn green">
    <i class="material-icons left">save</i>
	<?php echo $loc->getText( "catalogSubmit" ); ?>
</button>

<a href="../catalog/biblio_marc_list.php?bibid=<?php echo HURL( $bibid ); ?>" class="waves-effect waves-light btn red">
    <i class="material-icons left">cancel</i>
	<?php echo $loc->getText( "catalogCancel" ); ?>
</a>

