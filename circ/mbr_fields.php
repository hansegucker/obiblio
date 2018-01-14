<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../functions/inputFuncs.php" );
require_once( '../classes/DmQuery.php' );
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm = $dmQ->getAssoc( 'mbr_classify_dm' );
$customFields  = $dmQ->getAssoc( 'member_fields_dm' );
$dmQ->close();
$fields = array(
	"mbrFldsCardNmbr"  => inputField( 'text', "barcodeNmbr", $mbr->getBarcodeNmbr() ),
	"mbrFldsFirstName" => inputField( 'text', "firstName", $mbr->getFirstName() ),
	"mbrFldsLastName"  => inputField( 'text', "lastName", $mbr->getLastName() ),
	"Mailing Address:" => inputField( 'textarea', "address", $mbr->getAddress() ),
	"mbrFldsEmail"     => inputField( 'text', "email", $mbr->getEmail() ),
	"mbrFldsHomePhone" => inputField( 'text', "homePhone", $mbr->getHomePhone() ),
	"mbrFldsWorkPhone" => inputField( 'text', "workPhone", $mbr->getWorkPhone() ),
);

$ids = array(
	"mbrFldsCardNmbr"  => "barcodeNmbr",
	"mbrFldsFirstName" => "firstName",
	"mbrFldsLastName"  => "lastName",
	"Mailing Address:" => "address",
	"mbrFldsEmail"     => "email",
	"mbrFldsHomePhone" => "homePhone",
	"mbrFldsWorkPhone" => "workPhone",
);

foreach ( $customFields as $name => $title ) {
	$fields[ $title . ':' ] = inputField( 'text', "custom_" . $name, $mbr->getCustom( $name ) );
	$ids[ $title . ':' ]    = "custom_" . $name;
}
$fields["mbrFldsMbrShip"]  = inputField( 'text', "membershipEnd", $mbr->getMembershipEnd() );
$fields["mbrFldsClassify"] = inputField( 'select', "classification", $mbr->getClassification(), null, $mbrClassifyDm );

$ids["mbrFldsMbrShip"]  = "membershipEnd";
$ids["mbrFldsClassify"] = "classification"

?>


<h3>
	<?php echo H( $headerWording ); ?>&nbsp;<?php echo $loc->getText( "mbrFldsHeader" ); ?>
</h3>

<?php
foreach ( $fields as $title => $html ) {
	?>
    <div class="input-field">
        <label for="<?php echo $ids[ $title ]; ?>">
			<?php echo $loc->getText( $title ); ?>
        </label>


		<?php echo $html; ?>
    </div>
	<?php
}
?>

<button type="submit" class="waves-effect waves-light btn green">
    <i class="material-icons left">send</i>
	<?php echo $loc->getText( "mbrFldsSubmit" ); ?>
</button>
<a href="<?php echo H( addslashes( $cancelLocation ) ); ?>" class="waves-effect waves-light btn red">
    <i class="material-icons left">cancel</i>
	<?php echo $loc->getText( "mbrFldsCancel" ); ?>
</a>