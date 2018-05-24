<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "admin";
$nav = "staff";

require_once( "../classes/Staff.php" );
require_once( "../classes/StaffQuery.php" );
require_once( "../functions/errorFuncs.php" );

require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

require_once( "../shared/logincheck.php" );

require_once( "../shared/header.php" );

$staffQ = new StaffQuery();
$staffQ->connect();
if ( $staffQ->errorOccurred() ) {
	$staffQ->close();
	displayErrorPage( $staffQ );
}
$staffQ->execSelect();
if ( $staffQ->errorOccurred() ) {
	$staffQ->close();
	displayErrorPage( $staffQ );
}

?>
<h3>
	<?php echo $loc->getText( "adminStaff_list_Columnheader" ); ?>
</h3>
<a href="../admin/staff_new_form.php?reset=Y" class="waves-effect waves-light btn green">
    <i class="material-icons left">add</i> <?php echo $loc->getText( "adminStaff_list_formHeader" ); ?>
</a>


<table>
    <tr>
        <th colspan="3" rowspan="2">
		    <?php echo $loc->getText( "adminStaff_list_Function" ); ?>
        </th>
        <th rowspan="2">
		    <?php echo $loc->getText( "adminStaff_edit_formLastname" ); ?>
        </th>
        <th rowspan="2">
		    <?php echo $loc->getText( "adminStaff_edit_formFirstname" ); ?>
        </th>
        <th rowspan="2">
		    <?php echo $loc->getText( "adminStaff_edit_formLogin" ); ?>
        </th>
        <th colspan="5">
	        <?php echo $loc->getText( "adminStaff_edit_formAuth" ); ?>
        </th>
        <th rowspan="2" valign="top">
	        <?php echo $loc->getText( "adminStaff_edit_formSuspended" ); ?>
        </th>
    </tr>
    <tr>
        <th>
	        <?php echo $loc->getText( "adminStaff_edit_formCirc" ); ?>
        </th>
        <th>
	        <?php echo $loc->getText( "adminStaff_edit_formUpdatemember" ); ?>
        </th>
        <th>
	        <?php echo $loc->getText( "adminStaff_edit_formCatalog" ); ?>
        </th>
        <th>
	        <?php echo $loc->getText( "adminStaff_edit_formAdmin" ); ?>
        </th>
        <th>
	        <?php echo $loc->getText( "adminStaff_edit_formReports" ); ?>
        </th>
    </tr>
	<?php
	$row_class = "primary";
	while ( $staff = $staffQ->fetchStaff() ) {
		?>
        <tr>
            <td>
                <a href="../admin/staff_edit_form.php?UID=<?php echo HURL( $staff->getUserid() ); ?>"
                   class="waves-effect waves-teal btn-flat">
                    <i class="material-icons center">edit</i>
                </a>
            </td>
            <td>
                <a href="../admin/staff_pwd_reset_form.php?UID=<?php echo HURL( $staff->getUserid() ); ?>"
                   class="waves-effect waves-teal btn-flat">
                    <i class="material-icons center">vpn_key</i>
                </a>
            </td>
            <td>
                <a href="../admin/staff_del_confirm.php?UID=<?php echo HURL( $staff->getUserid() ); ?>&amp;LAST=<?php
		        echo HURL( $staff->getLastName() ); ?>&amp;FIRST=<?php echo HURL( $staff->getFirstName() ); ?>"
                   class="waves-effect waves-teal btn-flat">
                    <i class="material-icons center">delete</i>
                </a>
            </td>
            <td>
		        <?php echo H( $staff->getLastName() ); ?>
            </td>
            <td>
		        <?php echo H( $staff->getFirstName() ); ?>
            </td>
            <td>
		        <?php echo H( $staff->getUsername() ); ?>
            </td>
            <td>
		        <?php if ( $staff->hasCircAuth() ) {
			        echo '<i class="material-icons">check</i>';

		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
            <td>
		        <?php if ( $staff->hasCircMbrAuth() ) {
			        echo '<i class="material-icons">check</i>';
		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
            <td>
		        <?php if ( $staff->hasCatalogAuth() ) {
			        echo '<i class="material-icons">check</i>';
		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
            <td>
		        <?php if ( $staff->hasAdminAuth() ) {
			        echo '<i class="material-icons">check</i>';
		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
            <td>
		        <?php if ( $staff->hasReportsAuth() ) {
			        echo '<i class="material-icons">check</i>';
		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
            <td>
		        <?php if ( $staff->isSuspended() ) {
			        echo '<i class="material-icons">check</i>';
		        } else {
			        echo '<i class="material-icons">clear</i>';
		        } ?>
            </td>
        </tr>
		<?php
		# swap row color
		if ( $row_class == "primary" ) {
			$row_class = "alt1";
		} else {
			$row_class = "primary";
		}
	}
	$staffQ->close();
	?>
</table>
<?php include( "../shared/footer.php" ); ?>
