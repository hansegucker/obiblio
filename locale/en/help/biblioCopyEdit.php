<h1>Copy New and Edit Pages:</h1>
<br><br>

Help Sub Sections:
<ul>
    <li><a href="#desc">Field Descriptions</a></li>
    <li><a href="#barc">Barcode Number entering from an external numbering structure</a></li>
    <li><a href="#auto">Barcode Number - Autogenerate</a></li>
    <li><a href="#seri">Copy Serial Numbers integrated in Barcode Numbers</a></li>
</ul>
<br><br>

<a name="desc">
    The following table provides descriptions for the fields located on the Copy New and Edit Pages.</a>
<br><br>

<table class="primary">
    <tr>
        <th>Field</th>
        <th>Description</th>
    </tr>
    <tr>
        <td class="primary" valign="top">Barcode Number</td>
        <td class="primary" valign="top">Unique code identifying a copy,
            maximum 20 characters. This field is required because it identifies the copy in Circulation forms
            (Check Out, Check In, Hold).
            <br>See also:
            <a href="../shared/help.php?page=barcodes">Understanding barcodes</a>
        </td>
    </tr>
    <tr>
        <td class="primary" valign="top">Description</td>
        <td class="primary" valign="top">Short text describing characteristics for a copy.</td>
    </tr>
    <tr>
        <td class="primary" valign="top">Status</td>
        <td class="primary" valign="top"><b>Only in Edit Copy</b>.
            <br>See also:
            <a href="../shared/help.php?page=status">Understanding bibliography status changes</a>
        </td>
    </tr>
</table>
<br><br>

<a name="barc">Barcode Number entering from an external numbering structure</a>:
<ul>
    <li>Enter Barcode Number manually, or use a barcode scanner if the copy is already labeled,</li>
    <li>Submit (Autogenerate unchecked).</li>
</ul>
<br>

<a name="auto">
    By submitting a new copy with the <input name="autobarco" type="checkbox" checked> Autogenerate</a>
option for the Barcode Number field checked, OpenBiblio tries to assign a unique Barcode Number
automatically, following the rules from the internal numbering structure:
<ul>
    <li>First part is calculated from the <i>bibid</i> by which the bibliography is internally known to
        OpenBiblio, with leading zeros. Default length is 5 digits, this can be changed by editing the value for
        $nzeros in biblio_copy_new.php
    </li>
    <li>Last part is equal to the internal <i>copyid</i> of the copy.</li>
</ul>
<br><br>

<a name="seri">
    Copy Serial Numbers integrated in Barcode Numbers</a> facilitate entering copy information from a simple
card file when unique numbers were not assigned, only serial numbers for multiple copies of a title.
<br>
The Barcode Lookup page has information on
<a href="../shared/help.php?page=opacLookup#seri">Recognizing Copy Serial Numbers in Autogenerated Barcode Numbers</a>.
<br>
When adding copies marked with serial number identification to a Bibliography:
<ul>
    <li>Check Autogenerate,</li>
    <li>submit new copies until Copy Serial Number corresponds with autogenerated Barcode Number last digit(s),</li>
    <li>delete permanently unavailable copies, edit status for others.</li>
</ul>
<br><br>
