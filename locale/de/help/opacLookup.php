<h1>Barcode-Suche:</h1>
<br><br>
Der Suchen-Link bei der Ausleihe, R�ckgabe und Reservierung �ffnet ein zweites Popup-Fenster, welches mit dem Onlinekatalog(OPAC) fast identisch ist. Im Ergebnisfenster einer Suche hat jedes Exemplar zus�tzliche Links (Ausleihe/R�ckgabe/Reservierung). Wenn man diesen Link ausw�hlt schlie�t sich das Fenster und gibt den Barcode zum Hauptfenster zur�ck, wo dieser �bermittelt werden kann.
<br><br>

Hilfe Untersektionen:
<ul>
    <li><a href="#exam">Beispiel: Auswahl eines Barcode aus dem Suchfenster</a></li>
    <li><a href="#seri">Erkennen von Seriennummern in automatisch generierten Barcodes</a></li>
</ul>
<br><br>

<a name="exam">
    Das folgende Beispiel zeigt den link um einen Barcode auszuw�hlen.</a>
Wenn Ihr Browser die Quickinfo unterst�tzt, dann zeigt Infos an, wenn Sie mit der Maus �ber die links fahren.
<br><br>

<!--**************************************************************************
    *  Printing result table EXAMPLE ALMOST COMPLETELY TRANSLATED BY $loc->getText 
    ************************************************************************** -->
<table class="primary">
    <tbody>
    <tr>
        <th colspan="3" align="left" nowrap="yes" valign="top">
            <?php echo $loc->getText("biblioSearchResults"); ?>:
        </th>
    </tr>

    <tr>

        <td class="primary" rowspan="2" align="center" nowrap="true" valign="top">
            1.<br>
            <a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">
                <img src="../images/book.gif" alt="book" align="bottom" border="0" height="20" width="20"></a>
        </td>
        <td class="primary" colspan="2" valign="top">
            <table class="primary" width="100%">
                <tbody>
                <tr>

                    <td class="noborder" valign="top" width="1%"><b><?php echo $loc->getText("biblioSearchTitle"); ?>
                            :</b></td>
                    <td class="noborder" colspan="3"><a href="#exam"
                                                        title="<?php echo $loc->getText("biblioSearchDetail"); ?>">Ribsy</a>
                    </td>
                </tr>
                <tr>
                    <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
                    <td class="noborder" colspan="3">Cleary,Beverly</td>
                </tr>
                <tr>
                    <td class="noborder" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
                    <td class="noborder" colspan="3"><font class="small">Buch</font></td>
                </tr>
                <tr>
                    <td class="noborder" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>
                    <td class="noborder" colspan="3"><font class="small">Jugendliteratur</font></td>

                </tr>
                <tr>
                    <td class="noborder" nowrap="yes" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
                    <td class="noborder" colspan="3"><font class="small">JF Cle </font></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000051
                <a href="#exam"
                   title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a>
                | <a href="#exam"
                     title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>
            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: verf�gbar</font></td>
    </tr>


    <tr>
        <td class="primary" rowspan="2" align="center" nowrap="true" valign="top">
            2.<br>
            <a href="#exam" title="<?php echo $loc->getText("biblioSearchDetail"); ?>">
                <img src="../images/book.gif" alt="book" align="bottom" border="0" height="20" width="20"></a>
        </td>
        <td class="primary" colspan="2" valign="top">
            <table class="primary" width="100%">

                <tbody>
                <tr>
                    <td class="noborder" valign="top" width="1%"><b><?php echo $loc->getText("biblioSearchTitle"); ?>
                            :</b></td>
                    <td class="noborder" colspan="3"><a href="#exam"
                                                        title="<?php echo $loc->getText("biblioSearchDetail"); ?>">Henry
                            Huggins</a></td>
                </tr>
                <tr>
                    <td class="noborder" valign="top"><b><?php echo $loc->getText("biblioSearchAuthor"); ?>:</b></td>
                    <td class="noborder" colspan="3">Cleary,Beverly</td>

                </tr>
                <tr>
                    <td class="noborder" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchMaterial"); ?>:</b></font></td>
                    <td class="noborder" colspan="3"><font class="small">Buch</font></td>
                </tr>
                <tr>
                    <td class="noborder" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchCollection"); ?>:</b></font></td>

                    <td class="noborder" colspan="3"><font class="small">Jugendliteratur</font></td>
                </tr>
                <tr>
                    <td class="noborder" nowrap="yes" valign="top"><font
                                class="small"><b><?php echo $loc->getText("biblioSearchCall"); ?>:</b></font></td>
                    <td class="noborder" colspan="3"><font class="small">JF Cle </font></td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>
    <tr>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000061
                <a href="#exam"
                   title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a>
                | <a href="#exam"
                     title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>
            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: verf�gbar</font></td>

    </tr>
    <tr>
        <td class="primary" align="center" nowrap="true" valign="top"><font class="small">
                3.
            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000062
                <a href="#exam"
                   title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a>
                | <a href="#exam"
                     title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>

            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: verf�gbar</font></td>
    </tr>
    <tr>
        <td class="primary" align="center" nowrap="true" valign="top"><font class="small">
                4.
            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyBCode"); ?></b>: 000063
                <a href="#exam"
                   title="<?php echo $loc->getText("biblioSearchBCode2Chk"); ?>"><?php echo $loc->getText("biblioSearchOutIn"); ?></a>
                | <a href="#exam"
                     title="<?php echo $loc->getText("biblioSearchBCode2Hold"); ?>"><?php echo $loc->getText("biblioSearchHold"); ?></a>

            </font></td>
        <td class="primary" nowrap="true"><font
                    class="small"><b><?php echo $loc->getText("biblioSearchCopyStatus"); ?></b>: verf�gbar</font></td>
    </tr>
    </tbody>
</table><br>

<a name="seri">
    Im Barcode-Suche-Beispiel oben, unterscheidet sich der Barcode nur in den letzten Ziffern.</a>
Dieses ist, weil diese Barcodes mit der Funktion
<a href="../shared/help.php?page=biblioCopyEdit#seri">Kopiere Serielle Nummern integriert in
    Barcodes</a> angelegt wurden, als die Exemplare erstellt wurden.
<br>
Dies und noch anderes wird erkl�rt in der Hilfe zu
<a href="../shared/help.php?page=biblioCopyEdit">Neues Exemplar und Exemplar bearbeiten</a>.
<br><br>
Beachten Sie, dass die Nummerierung in der linken Spalte, unabh�ngig zu Kopiere Serielle Nummern integriert in Barcodes ist.
