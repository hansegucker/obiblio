<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab              = "circulation";
$nav              = "view";
$focus_form_name  = "barcodesearch";
$focus_form_field = "barcodeNmbr";

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../classes/Member.php" );
require_once( "../classes/MemberQuery.php" );
require_once( "../classes/BiblioSearch.php" );
require_once( "../classes/BiblioSearchQuery.php" );
require_once( "../classes/DmQuery.php" );
require_once( "../shared/get_form_vars.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$mbrid = $_GET["mbrid"];
if ( isset( $_GET["msg"] ) ) {
	$msg = "<font class=\"error\">" . H( $_GET["msg"] ) . "</font><br><br>";
} else {
	$msg = "";
}

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$mbrClassifyDm      = $dmQ->getAssoc( "mbr_classify_dm" );
$materialTypeDm     = $dmQ->getAssoc( "material_type_dm" );
$materialImageFiles = $dmQ->getAssoc( "material_type_dm", "image_file" );
$dmQ->close();

#****************************************************************************
#*  Search database for member
#****************************************************************************
$mbrQ = new MemberQuery();
$mbrQ->connect();
$mbr = $mbrQ->get( $mbrid );
$mbrQ->close();

#**************************************************************************
#*  Show member checkouts
#**************************************************************************
?>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $loc->getText( "mbrPrintCheckoutsTitle", array( "mbrName" => $mbr->getFirstLastName() ) ); ?></title>
</head>
<body onLoad="self.focus();self.print();">


<table>
    <tr>
        <td>
            <h1>
				<?php echo $loc->getText( "mbrPrintCheckoutsTitle", array( "mbrName" => $mbr->getFirstLastName() ) ); ?>
            </h1>
        </td>
        <td>
            <a href="javascript:window.close()">
				<?php echo $loc->getText( "mbrPrintCloseWindow" ); ?>
            </a>
        </td>
    </tr>
</table>


<table>
    <tr>
        <td><?php echo $loc->getText( "mbrPrintCheckoutsHdr1" ); ?></td>
        <td><?php echo H( date( "F j, Y, g:i a" ) ); ?></td>
    </tr>
    <tr>
        <td><?php echo $loc->getText( "mbrPrintCheckoutsHdr2" ); ?></td>
        <td><?php echo H( $mbr->getFirstLastName() ); ?></td>
    </tr>
    <tr>
        <td><?php echo $loc->getText( "mbrPrintCheckoutsHdr3" ); ?></td>
        <td><?php echo H( $mbr->getBarcodeNmbr() ); ?></td>
    </tr>
    <tr>
        <td><?php echo $loc->getText( "mbrPrintCheckoutsHdr4" ); ?></td>
        <td><?php echo H( $mbrClassifyDm[ $mbr->getClassification() ] ); ?></td>
    </tr>
</table>
<br>
<table>
    <tr>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr1" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr2" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr4" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr5" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr6" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "mbrViewOutHdr7" ); ?>
        </th>
    </tr>

	<?php
	#****************************************************************************
	#*  Search database for BiblioStatus data
	#****************************************************************************
	$biblioQ = new BiblioSearchQuery();
	$biblioQ->connect();
	if ( $biblioQ->errorOccurred() ) {
		$biblioQ->close();
		displayErrorPage( $biblioQ );
	}
	if ( ! $biblioQ->doQuery( OBIB_STATUS_OUT, $mbrid ) ) {
		$biblioQ->close();
		displayErrorPage( $biblioQ );
	}
	if ( $biblioQ->getRowCount() == 0 ) {
		?>
        <tr>
            <td>
		        <?php echo $loc->getText( "mbrViewNoCheckouts" ); ?>
            </td>
        </tr>
		<?php
	} else {
		while ( $biblio = $biblioQ->fetchRow() ) {
			?>
            <tr>
                <td>
		            <?php echo H( $biblio->getStatusBeginDt() ); ?>
                </td>
                <td>
                    <img src="../images/<?php echo HURL( $materialImageFiles[ $biblio->getMaterialCd() ] ); ?>"
                         alt="<?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>">
		            <?php echo H( $materialTypeDm[ $biblio->getMaterialCd() ] ); ?>
                </td>
                <td>
		            <?php echo H( $biblio->getTitle() ); ?>
                </td>
                <td>
		            <?php echo H( $biblio->getAuthor() ); ?>
                </td>
                <td>
		            <?php echo H( $biblio->getDueBackDt() ); ?>
                </td>
                <td>
		            <?php echo H( $biblio->getDaysLate() ); ?>
                </td>
            </tr>
			<?php
		}
	}
	$biblioQ->close();
	?>

</table>

