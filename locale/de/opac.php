<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

/**********************************************************************************
 *   Instructions for translators:
 *
 *   All gettext key/value pairs are specified as follows:
 *     $trans["key"] = "<php translation code to set the $text variable>";
 *   Allowing translators the ability to execute php code withint the transFunc string
 *   provides the maximum amount of flexibility to format the languange syntax.
 *
 *   Formatting rules:
 *   - Resulting translation string must be stored in a variable called $text.
 *   - Input arguments must be surrounded by % characters (i.e. %pageCount%).
 *   - A backslash ('\') needs to be placed before any special php characters 
 *     (such as $, ", etc.) within the php translation code.
 *
 *   Simple Example:
 *     $trans["homeWelcome"]       = "\$text='Welcome to OpenBiblio';";
 *
 *   Example Containing Argument Substitution:
 *     $trans["searchResult"]      = "\$text='page %page% of %pages%';";
 *
 *   Example Containing a PHP If Statment and Argument Substitution:
 *     $trans["searchResult"]      = 
 *       "if (%items% == 1) {
 *         \$text = '%items% result';
 *       } else {
 *         \$text = '%items% results';
 *       }";
 *
 **********************************************************************************
 */


#****************************************************************************
#*  Translation text for page index.php
#****************************************************************************
$trans["opac_Header"]        = "\$text='Onlinekatalog (OPAC)';";
$trans["opac_WelcomeMsg"]    = "\$text=
'Willkommen im Onlinekatalog unserer Bibliothek. Durchsuchen Sie unseren Katalog nach Informationen �ber die Medien in unserem Bestand.';";
$trans["opac_SearchTitle"]   = "\$text='Suche Medium durch:';";
$trans["opac_Keyword"]       = "\$text='Suchbegriff';";
$trans["opac_Title"]         = "\$text='Titel';";
$trans["opac_Author"]        = "\$text='Autor';";
$trans["opac_Subject"]       = "\$text='Schlagwort';";
$trans["opac_Callno"]        = "\$text='Standort';";
$trans["opac_Search"]        = "\$text='Suche';";

#****************************************************************************
#*  Translation text for page loginform.php
#****************************************************************************
$trans["loginFormTbleHdr"]         = "\$text = 'Benutzer Login';";
$trans["MemberID"]        	   = "\$text = 'Benutzernummer';";
$trans["Secret Word"]	           = "\$text = 'Geheimwort';";
$trans["loginFormLogin"]           = "\$text = 'Login';";

#****************************************************************************
#*  Translation text for page login.php
#****************************************************************************
$trans["MemberID is required."]    = "\$text = 'Benutzernummer erforderlich';";
$trans["Secret Word is required."] = "\$text = 'Geheimwort erforderlich';";
$trans["No Memberfield 'secret' defined. Member-Login is deactivated!"]	= "\$text = 'Kein Mitgliederfeld 'secret' ist eingerichtet. Der Benutzerlogin wurde deaktiviert.';";
$trans["Invalid Logon. Maybe you don't have a Secret Word? Please ask the Staff!"] = "\$text = 'Falsches Login. Eventuell haben Sie noch kein Geheimwort eingerichtet? Sprechen Sie bitte das Personal an!';";

#****************************************************************************
#*  Translation text for page mbr_account.php
#****************************************************************************
$trans["mbrViewBalMsg"]           = "\$text='Bemerkung: Benutzer hat ausstehende Geb�hren von %bal%.';";
$trans["mbrViewHead1"]            = "\$text='Benutzerinformation:';";
$trans["mbrViewName"]             = "\$text='Name:';";
$trans["mbrViewCardNmbr"]         = "\$text='Benutzernummer:';";
$trans["mbrViewMbrShipEnd"]       = "\$text='bezahlt bis:';";
$trans["mbrViewMbrShipNoEnd"]     = "\$text='unendlich/nicht benutzt';";
$trans["mbrViewHead4"]            = "\$text='Derzeit ausgeliehene Medien:';";
$trans["mbrPrintCheckouts"]	  = "\$text='Ausgeliehene Medien drucken';";
$trans["mbrViewOutHdr1"]          = "\$text='Ausgeliehen';";
$trans["mbrViewOutHdr2"]          = "\$text='Medienart';";
$trans["mbrViewOutHdr3"]          = "\$text='Mediennummer';";
$trans["mbrViewOutHdr4"]          = "\$text='Titel';";
$trans["mbrViewOutHdr5"]          = "\$text='Autor';";
$trans["mbrViewOutHdr6"]          = "\$text='R�ckgabe';";
$trans["mbrViewOutHdr7"]          = "\$text='�berf�llige<br>Tage';";
$trans["mbrViewOutHdr8"]          = "\$text='Verl�ngerungen';";
$trans["mbrViewNoCheckouts"]      = "\$text='Derzeit keine Medien ausgeliehen.';";
$trans["Cannot renew item *"]     = "\$text='Kann Medium nicht verl�ngern *';";
$trans["Renew item"]              = "\$text='Verl�ngere Medium';";
$trans["mbrViewOutHdr9"]          = "\$text='Mal';";
$trans["* You cannot renew, if you are more then 7 days too late"] = "\$text='* Medien, die mehr als 7 Tage �berf�llig sind, k�nnen nicht verl�ngert werden.';";
$trans["mbrViewHead5"]            = "\$text='Vorbestellen:';";
$trans["mbrViewBarcode"]          = "\$text='Mediennummer:';";
$trans["indexSearch"]             = "\$text='Suche';";
$trans["mbrViewPlaceHold"]        = "\$text='Vorbestellen';";
$trans["mbrViewHead6"]            = "\$text='Derzeit vorbestellte Medien:';";
$trans["mbrViewHoldHdr2"]         = "\$text='Vorbestellt';";
$trans["mbrViewHoldHdr3"]         = "\$text='Medienart';";
$trans["mbrViewHoldHdr4"]         = "\$text='Mediennummer';";
$trans["mbrViewHoldHdr5"]         = "\$text='Titel';";
$trans["mbrViewHoldHdr6"]         = "\$text='Autor';";
$trans["mbrViewHoldHdr7"]         = "\$text='Status';";
$trans["mbrViewHoldHdr8"]         = "\$text='R�ckgabe';";
$trans["mbrViewNoHolds"]          = "\$text='Derzeit keine Medien vorbestellt.';";
$trans["Please send a mail to delete holds"] = "\$text='Wenn Sie Vorbestellungen l�schen wollen, mailen Sie uns bitte!';";

#****************************************************************************
#*  Translation text for page mbr_print_checkouts.php
#****************************************************************************
$trans["mbrPrintCheckoutsTitle"]  = "\$text='Ausleihen von %mbrName%';";
$trans["mbrPrintCheckoutsHdr1"]   = "\$text='Aktuelles Datum:';";
$trans["mbrPrintCheckoutsHdr2"]   = "\$text='Benutzer:';";
$trans["mbrPrintCheckoutsHdr3"]   = "\$text='Benutzernummer:';";
$trans["mbrPrintCloseWindow"]     = "\$text='Schlie�e Fenster';";

#****************************************************************************
#*  Translation text for page place_hold.php
#****************************************************************************
$trans["placeHoldErr2"]           = "\$text='Die Mediennummer exitiert nicht.';";
$trans["placeHoldErr3"]           = "\$text='Das Mitglied hat dieses Medium bereits ausgeliehen - keine Vorbestellung angelegt.';";
$trans["This item is not checked out or on hold."]           = "\$text='Dieses Exemplar ist weder vorbestellt noch ausgeliehen.';";

?>
