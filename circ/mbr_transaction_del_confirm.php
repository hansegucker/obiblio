<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once( "../shared/common.php" );
$tab            = "circulation";
$nav            = "account";
$restrictInDemo = true;
require_once( "../shared/logincheck.php" );
require_once( "../classes/Localize.php" );
$loc = new Localize( OBIB_LOCALE, $tab );

#****************************************************************************
#*  Retrieving get var
#****************************************************************************
$mbrid   = $_GET["mbrid"];
$transid = $_GET["transid"];

#**************************************************************************
#*  Destroy form values and errors
#**************************************************************************
unset( $_SESSION["postVars"] );
unset( $_SESSION["pageErrors"] );

#**************************************************************************
#*  Show confirm page
#**************************************************************************
require_once( "../shared/header.php" );
?>

<!--<form name="delbiblioform" method="POST" action="../circ/mbr_account.php?mbrid=<?php /*echo HURL( $mbrid ); */ ?>">
	<?php /*echo $loc->getText( "mbrTransDelConfirmMsg" ); */ ?>
    <input type="button"
           onClick="self.location='../circ/mbr_transaction_del.php?mbrid=<?php /*echo H( addslashes( U( $mbrid ) ) ); */ ?>&amp;transid=<?php /*echo H( addslashes( U( $transid ) ) ); */ ?>'"
           value="<?php /*echo $loc->getText( "circDelete" ); */ ?>" class="button">
    <input type="submit" value="<?php /*echo $loc->getText( "circCancel" ); */ ?>" class="button">
</form>-->


<p class="flow-text"><?php echo $loc->getText( "mbrTransDelConfirmMsg" ); ?></p>

<a class="waves-effect waves-light btn red"
   href="../circ/mbr_transaction_del.php?mbrid=<?php echo H( addslashes( U( $mbrid ) ) ); ?>&amp;transid=<?php echo H( addslashes( U( $transid ) ) ); ?>">
    <i class="material-icons left">delete</i>
	<?php echo $loc->getText( "circDelete" ); ?>
</a>
<a class="waves-effect waves-light btn" href="../circ/mbr_account.php?mbrid=<?php echo HURL( $mbrid ); ?>">
    <i class="material-icons left">cancel</i>
	<?php echo $loc->getText( "circCancel" ); ?>
</a>

