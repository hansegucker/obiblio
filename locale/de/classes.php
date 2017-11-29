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
#*  Translation text for class Biblio
#****************************************************************************
$trans["biblioError1"]            = "\$text = 'Der Standort wird ben�tigt.';";

#****************************************************************************
#*  Translation text for class BiblioField
#****************************************************************************
$trans["biblioFieldError1"]       = "\$text = 'Das Feld wird ben�tigt.';";
$trans["biblioFieldError2"]       = "\$text = 'Der Tag muss numerisch sein.';";

#****************************************************************************
#*  Translation text for class BiblioQuery
#****************************************************************************
$trans["biblioQueryQueryErr1"]    = "\$text = 'Fehler beim Zugriff auf die Medieninformation.';";
$trans["biblioQueryQueryErr2"]    = "\$text = 'Fehler beim Zugriff auf die Medienfelder.';";
$trans["biblioQueryInsertErr1"]   = "\$text = 'Fehler beim Einf�gen des neuen Mediums.';";
$trans["biblioQueryInsertErr2"]   = "\$text = 'Fehler beim Einf�gen des neuen Medienfeldes.';";
$trans["biblioQueryUpdateErr1"]   = "\$text = 'Fehler beim Aktualisieren des Mediums.';";
$trans["biblioQueryUpdateErr2"]   = "\$text = 'Fehler bei der Aktualisierung des Mediums beim Medienfeld.';";
$trans["biblioQueryDeleteErr"]    = "\$text = 'Fehler beim L�schen des Mediums.';";

#****************************************************************************
#*  Translation text for class BiblioSearchQuery
#****************************************************************************
$trans["biblioSearchQueryErr1"]   = "\$text = 'Fehler beim Z�hlen der Suchergenisse.';";
$trans["biblioSearchQueryErr2"]   = "\$text = 'Fehler beim Suchen nach Medieninformationen.';";
$trans["biblioSearchQueryErr3"]   = "\$text = 'Fehler beim Lesen der Medieninformationen.';";

#****************************************************************************
#*  Translation text for class BiblioCopy
#****************************************************************************
$trans["biblioCopyError1"]        = "\$text = 'Die Mediennummer wird ben�tigt.';";
$trans["biblioCopyError2"]        = "\$text = 'Ung�ltige Zeichen im Barcode.';";

#****************************************************************************
#*  Translation text for class BiblioCopyQuery
#****************************************************************************
$trans["biblioCopyQueryErr1"]     = "\$text = 'Fehler bei der Pr�fung der Mediennummer.';";
$trans["biblioCopyQueryErr2"]     = "\$text = 'Mediennummer %barcodeNmbr% wird bereits benutzt.';";
$trans["biblioCopyQueryErr3"]     = "\$text = 'Fehler beim Einf�gen des neuen Exemplars.';";
$trans["biblioCopyQueryErr4"]     = "\$text = 'Fehler beim Zugriff auf das Exemplar.';";
$trans["biblioCopyQueryErr5"]     = "\$text = 'Fehler bei der Aktualisierung des Exemplars.';";
$trans["biblioCopyQueryErr6"]     = "\$text = 'Fehler beim L�schen des Exemplars.';";
$trans["biblioCopyQueryErr7"]     = "\$text = 'Fehler beim Zugriff auf die Medieninformation um den Genrecode zu bekommen.';";
$trans["biblioCopyQueryErr8"]     = "\$text = 'Fehler beim Zugriff auf die Genreinforamtionen um R�ckgabe-Datum zu erstellen.';";
$trans["biblioCopyQueryErr9"]     = "\$text = 'Fehler bei der R�ckgabe des Exemplars';";
$trans["biblioCopyQueryErr10"]    = "\$text = 'Fehler beim �berpr�fen der Ausleihlimits';";
$trans["biblioCopyQueryErr11"]    = "\$text = 'Fehler beim Ermitteln der Kopie mit der gr��ten Nummer.';";

#****************************************************************************
#*  Translation text for class BiblioFieldQuery
#****************************************************************************
$trans["biblioFieldQueryErr1"]    = "\$text = 'Fehler beim Lesen eines Medienfeldes.';";
$trans["biblioFieldQueryErr2"]    = "\$text = 'Fehler beim Lesen eines Medienfeldes.';";
$trans["biblioFieldQueryInsertErr"] = "\$text = 'Fehler beim Einf�gen eines Medienfeldes.';";
$trans["biblioFieldQueryUpdateErr"] = "\$text = 'Fehler beim Aktualisieren eines Medienfeldes.';";
$trans["biblioFieldQueryDeleteErr"] = "\$text = 'Fehler beim L�schen eines Medienfeldes.';";

#****************************************************************************
#*  Translation text for class UsmarcBlockDmQuery
#****************************************************************************
$trans["usmarcBlockDmQueryErr1"]  = "\$text = 'Fehler beim Zugriff auf die MARC-Bl�cke.';";

#****************************************************************************
#*  Translation text for class UsmarcTagDmQuery
#****************************************************************************
$trans["usmarcTagDmQueryErr1"]    = "\$text = 'Fehler beim Zugriff auf die MARC-Tags.';";

#****************************************************************************
#*  Translation text for class UsmarcSubfieldDmQuery
#****************************************************************************
$trans["usmarcSubfldDmQueryErr1"] = "\$text = 'Fehler beim Zugriff auf die MARC-Unterfelder.';";

#****************************************************************************
#*  Translation text for class BiblioHoldQuery
#****************************************************************************
$trans["biblioHoldQueryErr1"]     = "\$text = 'Fehler beim Zugriff auf Vorbestellung durch Mediennummer.';";
$trans["biblioHoldQueryErr2"]     = "\$text = 'Fehler beim Zugriff auf Vorbestellung durch Benutzernummer.';";
$trans["biblioHoldQueryErr3"]     = "\$text = 'Fehler bei der Vorbestellung wegen Pr�fung der Mediennummer.';";
$trans["biblioHoldQueryErr4"]     = "\$text = 'Fehler beim Einf�gen der Vorbestellung.';";
$trans["biblioHoldQueryErr5"]     = "\$text = 'Fehler beim L�schen der Vorbestellung.';";
$trans["biblioHoldQueryErr6"]     = "\$text = 'Fehler beim Ermitteln der ersten Vorbestellung f�r dieses Exemplar.';";

#****************************************************************************
#*  Translation text for class ReportQuery
#****************************************************************************
$trans["reportQueryErr1"]         = "\$text = 'Fehler beim Erstellen der Berichte.';";

#****************************************************************************
#*  Translation text for class ReportCriteria
#****************************************************************************
$trans["reportCriteriaErr1"]      = "\$text = 'Ein nichtmumerischer Wert ist in einer Zahlenspalte nicht erlaubt.';";
$trans["reportCriteriaDateTimeErr"] = "\$text = 'Ung�ltiges Zeitformat.';";
$trans["reportCriteriaDateErr"]   = "\$text = 'Ung�ltiges Datumsformat.';";

#****************************************************************************
#*  Translation text for class Staff
#****************************************************************************
$trans["staffLastNameReqErr"]     = "\$text = 'Nachname wird ben�tigt.';";
$trans["staffUserNameLenErr"]     = "\$text = 'Benutzername muss mindestens 4 Zeichen lang sein.';";
$trans["staffUserNameCharErr"]    = "\$text = 'Benutzername darf kein Leerzeichen enthalten.';";
$trans["staffPwdLenErr"]          = "\$text = 'Passwort muss mindestens 4 Zeichen lang sein.';";
$trans["staffPwdCharErr"]         = "\$text = 'Passwort darf kein Leerzeichen enthalten.';";
$trans["staffPwdMatchErr"]        = "\$text = 'Passw�rter sind nicht identisch.';";

#****************************************************************************
#*  Translation text for class Member
#****************************************************************************
$trans["memberBarcodeReqErr"]     = "\$text = 'Die Benutzernummer wird ben�tigt.';";
$trans["memberBarcodeCharErr"]    = "\$text = 'Ung�ltige Zeichen in Benutzernummer.';";
$trans["memberLastNameReqErr"]    = "\$text = 'Nachname wird ben�tigt.';";
$trans["memberFirstNameReqErr"]   = "\$text = 'Vorname wird ben�tigt.';";

#****************************************************************************
#*  Translation text for class LabelFormat and LetterFormat
#****************************************************************************
$trans["labelFormatFontErr"]      = "\$text = 'Ung�ltige Schriftart in der Etikettendefinitionsdatei. Erlaubte Schriftarten sind Courier, Helvetica und Times-Roman.';";
$trans["labelFormatFontSizeErr"]  = "\$text = 'Ung�ltige Schriftgr��e in der Etikettendefinitionsdatei. Die Schriftgr��e mu� numerisch sein.';";
$trans["labelFormatFontSizeErr2"] = "\$text = 'Ung�ltige Schriftgr��e in der Etikettendefinitionsdatei. Die Schriftgr��e mu� gr��er als Null sein.';";
$trans["labelFormatLMarginErr"]   = "\$text = 'Ung�ltiger linker Rand in der Etikettendefinitionsdatei. Der linke Rand mu� numerisch sein.';";
$trans["labelFormatLMarginErr2"]  = "\$text = 'Ung�ltiger linker Rand in der Etikettendefinitionsdatei. Der linke Rand mu� gr��er als Null sein.';";
$trans["labelFormatRMarginErr"]   = "\$text = 'Ung�ltiger rechter Rand in der Etikettendefinitionsdatei. Der rechte Rand mu� numerisch sein.';";
$trans["labelFormatRMarginErr2"]  = "\$text = 'Ung�ltiger rechter Rand in der Etikettendefinitionsdatei. Der rechte Rand mu� gr��er als Null sein.';";
$trans["labelFormatTMarginErr"]   = "\$text = 'Ung�ltiger oberer Rand in der Etikettendefinitionsdatei. Der obere Rand mu� numerisch sein.';";
$trans["labelFormatTMarginErr2"]  = "\$text = 'Ung�ltiger oberer Rand in der Etikettendefinitionsdatei. Der obere Rand mu� gr��er als Null sein.';";
$trans["labelFormatBMarginErr"]   = "\$text = 'Ung�ltiger unterer Rand in der Etikettendefinitionsdatei. Der untere Rand mu� numerisch sein.';";
$trans["labelFormatBMarginErr2"]  = "\$text = 'Ung�ltiger unterer Rand in der Etikettendefinitionsdatei. Der untere Rand mu� gr��er als Null sein.';";
$trans["labelFormatColErr"]       = "\$text = 'Ung�ltige Spalten in der Etikettendefinitionsdatei. Die Spalten m�ssen numerisch sein.';";
$trans["labelFormatColErr2"]      = "\$text = 'Ung�ltige Spalten in der Etikettendefinitionsdatei. Die Spalten m�ssen gr��er als Null sein.';";
$trans["labelFormatWidthErr"]     = "\$text = 'Ung�ltige Breite in der Etikettendefinitionsdatei. Die Breite mu� numerisch sein.';";
$trans["labelFormatWidthErr2"]    = "\$text = 'Ung�ltige Breite in der Etikettendefinitionsdatei. Die Breite mu� gr��er als Null sein.';";
$trans["labelFormatHeightErr"]    = "\$text = 'Ung�ltige H�he in der Etikettendefinitionsdatei. Die H�he mu� numerisch sein.';";
$trans["labelFormatHeightErr2"]   = "\$text = 'Ung�ltige H�he in der Etikettendefinitionsdatei. Die H�he mu� gr��er als Null sein.';";
$trans["labelFormatNoLabelsErr"]  = "\$text = 'Ung�ltige Zeilen in der Etikettendefinitionsdatei.';";

#****************************************************************************
#*  Translation text for class BiblioStatusHistQuery
#****************************************************************************
$trans["biblioStatusHistQueryErr1"] = "\$text = 'Fehler die Ausleihhistory durch die Mediennummer zu bekommen.';";
$trans["biblioStatusHistQueryErr2"] = "\$text = 'Fehler die Ausleihhistory durch die Benutzernummer zu bekommen.';";
$trans["biblioStatusHistQueryErr3"] = "\$text = 'Fehler beim Einf�gen der Ausleihhistory';";
$trans["biblioStatusHistQueryErr4"] = "\$text = 'Fehler die Ausleihhistory durch die Mediennummer zu l�schen.';";
$trans["biblioStatusHistQueryErr5"] = "\$text = 'Fehler die Ausleihhistory durch die Benutzernummer zu l�schen.';";

#****************************************************************************
#*  Translation text for class MemberAccountTransaction
#****************************************************************************
$trans["memberAccountTransError1"]  = "\$text = 'Der Betrag wird ben�tigt.';";
$trans["memberAccountTransError2"]  = "\$text = 'Der Betrag mu� numerisch sein.';";
$trans["memberAccountTransError3"]  = "\$text = 'Die Beschreibung wird ben�tigt.';";
$trans["Amount must be greater than zero."]  = "\$text = 'Der Betrag mu� gr��er als Null sein.';";

#****************************************************************************
#*  Translation text for class MemberAccountQuery
#****************************************************************************
$trans["memberAccountQueryErr1"]    = "\$text = 'Fehler beim Zugriff auf die Benutzerinformationen.';";
$trans["memberAccountQueryErr2"]    = "\$text = 'Fehler beim Einf�gen von Benutzerinformationen.';";
$trans["memberAccountQueryErr3"]    = "\$text = 'Fehler beim L�schen von Benutzerinformationen.';";

#****************************************************************************
#*  Translation text for class CircQuery
#****************************************************************************
$trans["Can't understand date: %err%"]                            = "\$text = 'Verstehe Datum nicht: %err%';";
$trans["Won't do checkouts for future dates."]                    = "\$text = 'Kann nicht an zuk�nftigem Datum ausleihen.';";
$trans["Bad member barcode: %bcode%"]                             = "\$text = 'Falsche Mitgliedsnummer: %bcode%';";
$trans["Member owes fines: checkout not allowed"]                 = "\$text = 'Beim Mitglied gibt es Geb�hren: Ausleihen nicht erlaubt';";
$trans["Member must renew membership before checking out."]       = "\$text = 'Das Mitglied muss seine Mitgliedschaft verl�ngern bevor es ausleihen darf.';";
$trans["Bad copy barcode: %bcode%"]                               = "\$text = 'Falsche Exemplarnummer: %bcode%';";
$trans["Item %bcode% has reached its renewal limit."]             = "\$text = 'Das Exemplar %bcode% hat sein Verl�ngerungslimit erreicht.';";
$trans["Item %bcode% is late and cannot be renewed."]             = "\$text = 'Das Exemplar %bcode% ist zu sp�t und darf nicht verl�ngert werden.';";
$trans["Item %bcode% is on hold."]                                = "\$text = 'Das Exemplar %bcode% ist schon vorbestellt.';";
$trans["Item %bcode% is already checked out to another member."]  = "\$text = 'Das Exemplar %bcode% ist bereits an ein anderes Mitglied verliehen.';";
$trans["Item %bcode% isn't out and cannot be renewed."]  	   = "\$text = 'Das Exemplar %bcode% ist nicht ausgeliehen und kann daher nicht verl�ngert werden.';";
$trans["Member has reached checkout limit for this collection."]  = "\$text = 'Das Mitglied hat sein Ausleihlimit f�r dieses Genre erreicht.';";
$trans["Checkouts are disallowed for this collection."]           = "\$text = 'Dieses Genre darf nicht verliehen werden.';";
$trans["Item is on hold for another member."]                     = "\$text = 'Das Exemplar ist f�r jemand anderen vorbestellt.';";
$trans["!!!Note : due date is after the end of the membership"] = "\$text = '!!!Hinweis : geplantes R�ckgabedatum ist nach dem Ende der Mitgliedschaft!';";
$trans["Can't change status to an earlier date on item %bcode%."] = "\$text = 'Kann den Status von Exemplar %bcode% nicht auf ein fr�heres Datum �ndern.';";
$trans["Can't change status more than once per second on item %bcode%."]  = "\$text = 'Kann den Status von Exemplar %bcode% nicht mehr als einmal pro Sekunde �ndern.';";
$trans["Won't do checkins for future dates."]                     = "\$text = 'Kann keine R�ckgaben f�r ein zuk�nftiges Datum machen.';";
$trans["Late fee (barcode=%barcode%)"]                            = "\$text = 'S�umnisgeb�hr (Barcode=%barcode%)';";

?>
