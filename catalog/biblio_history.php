<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab = "cataloging";
$nav = "history";

require_once( "../functions/inputFuncs.php" );
require_once( "../shared/logincheck.php" );
require_once( "../classes/BiblioStatusHist.php" );
require_once( "../classes/BiblioStatusHistQuery.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Checking for get vars.  Go back to form if none found.
#****************************************************************************
if ( count( $_GET ) == 0 ) {
	header( "Location: ../circ/index.php" );
	exit();
}

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$bibid = $_GET["bibid"];

#****************************************************************************
#*  Loading a few domain tables into associative arrays
#****************************************************************************
$dmQ = new DmQuery();
$dmQ->connect();
$biblioStatusDm = $dmQ->getAssoc( "biblio_status_dm" );
$dmQ->close();

#****************************************************************************
#*  Search database for member history
#****************************************************************************
$histQ = new BiblioStatusHistQuery();
$histQ->connect();
if ( $histQ->errorOccurred() ) {
	$histQ->close();
	displayErrorPage( $histQ );
}
if ( ! $histQ->queryByBibid( $bibid ) ) {
	$histQ->close();
	displayErrorPage( $histQ );
}

#**************************************************************************
#*  Show biblio checkout history
#**************************************************************************
require_once( "../shared/header.php" );
?>

<h5>
	<?php echo $loc->getText( "Bibliography Checkout History:" ); ?>
</h5>

<table>
    <tr>
        <th>
		    <?php echo $loc->getText( "Date" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "Barcode" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "New Status" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "Member" ); ?>
        </th>
        <th>
		    <?php echo $loc->getText( "Due Date" ); ?>
        </th>
    </tr>

	<?php
	if ( $histQ->getRowCount() == 0 ) {
		?>
        <tr>
            <td>
		        <?php echo $loc->getText( "No history was found." ); ?>
            </td>
        </tr>
		<?php
	} else {
		while ( $hist = $histQ->fetchRow() ) {
			?>
            <tr>
                <td>
		            <?php echo H( $hist->getStatusBeginDt() ); ?>
                </td>
                <td>
		            <?php echo H( $hist->getBiblioBarcodeNmbr() ); ?>
                </td>
                <td>
		            <?php echo H( $biblioStatusDm[ $hist->getStatusCd() ] ); ?>
                </td>
                <td>
		            <?php if ( $hist->getMbrid() ) { ?>
                        <a href="../circ/mbr_view.php?mbrid=<?php echo HURL( $hist->getMbrid() ); ?>"><?php echo H( $hist->getLastName() . ", " . $hist->getFirstName() ); ?></a>
		            <?php } ?>
                </td>
                <td>
		            <?php echo H( $hist->getDueBackDt() ); ?>
                </td>
            </tr>
			<?php
		}
	}
	$histQ->close();

	?>
</table>

<?php require_once( "../shared/footer.php" ); ?>
