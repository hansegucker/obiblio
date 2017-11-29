<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  $tab = "circulation";
  $nav = "checkin";
  $restrictInDemo = true;
  require_once("../shared/logincheck.php");

  require_once("../classes/CircQuery.php");
  require_once("../functions/formatFuncs.php");
  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);

  if (count($_POST) == 0  && count($_GET) == 0) {
    header("Location: ../circ/checkin_form.php?reset=Y");
    exit();
  }

  if ( $_GET[barcodeNmbr] ) {
         $barcode = trim($_GET[barcodeNmbr]);
  }
    else {
         $barcode = trim($_POST["barcodeNmbr"]);
  }

  $circQ = new CircQuery();
  list($info, $err) = $circQ->shelving_cart_e($barcode);
  if ($err) $err = $err->toStr();
  
  if ($err) {
    $postVars["barcodeNmbr"] = $barcode;
    $pageErrors["barcodeNmbr"] = $err;
    $_SESSION["postVars"] = $postVars;
    $_SESSION["pageErrors"] = $pageErrors;
    header("Location: ../circ/checkin_form.php");
    exit();
  }

  unset($_SESSION["postVars"]);
  unset($_SESSION["pageErrors"]);

  $params = "?barcode=".U($barcode);
  if ($info['mbrid']) {
    $params .= "&mbrid=".U($info['mbrid']);
  }
  if ($info['late']) {
    $params .= "&late=".U($info['late']);
  }
  if ($info['hold']) {
    header("Location: ../circ/hold_message.php".$params);
  } else {
    header("Location: ../circ/checkin_form.php".$params);
  }
