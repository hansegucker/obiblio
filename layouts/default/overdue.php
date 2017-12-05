<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */

require_once('../classes/Lay.php');
require_once('../classes/MemberQuery.php');
require_once('../classes/Localize.php');

class Layout_overdue
{
    function render($rpt)
    {
        $loc = new Localize(OBIB_LOCALE, 'reports');

        list($rpt, $errs) = $rpt->variant_el(array('order_by' => 'member'));
        if (!empty($errs)) {
            Fatal::internalError('Unexpected report error');
        }

        $mbrQ = new MemberQuery;

        $lay = new Lay;
        $lay->pushFont('Helvetica', 10);
        $lay->container('Columns', array(
            'margin-left' => '1in', 'margin-right' => '1in',
            'margin-top' => '1in', 'margin-bottom' => '1in',
        ));
        $mbr = NULL;
        $oldmbr = NULL;
        while ($row = $rpt->each()) {
            if ($row['mbrid'] != $oldmbr) {
                if ($oldmbr !== NULL) {
                    $lay->close();
                    $lay->container('Columns', array(
                        'margin-left' => '1in', 'margin-right' => '1in',
                        'margin-top' => '1in', 'margin-bottom' => '1in',
                    ));
                }
                $mbr = $mbrQ->get($row['mbrid']);
                $oldmbr = $row['mbrid'];
                $lay->container('Column', array('margin-left' => '3.25in'));
                $lay->container('TextLine');
                $lay->text(date('m/d/Y'));
                $lay->close();
                $lay->element('Spacer', array('height' => 14));
                $lines = array(
                    OBIB_LIBRARY_NAME,
                    //'phone: '.OBIB_LIBRARY_PHONE,
                    $loc->getText('overdueHours') . OBIB_LIBRARY_HOURS,
                );
                foreach ($lines as $l) {
                    $lay->container('TextLine');
                    $lay->text($l);
                    $lay->close();
                }
                $lay->close();
                $lay->element('Spacer', array('height' => 14));
                $lay->container('TextLine');
                $lay->text($mbr->getFirstName() . ' ' . $mbr->getLastName());
                $lay->close();
                foreach (explode("\n", $mbr->getAddress()) as $l) {
                    $lay->container('TextLine');
                    $lay->text($l);
                    $lay->close();
                }
                $lay->element('Spacer', array('height' => 14));
                $lay->container('TextLine');
                $lay->text($loc->getText('overdueGreetingBefore') . $mbr->getFirstName() . ' ' . $mbr->getLastName() . $loc->getText('overdueGreetingAfter'));
                $lay->close();
                $lay->element('Spacer', array('height' => 9));
                $lay->container('Paragraph');
                $lay->container('TextLines');
                $lay->text($loc->getText('overdueText'));
                $lay->close();
                $lay->close();
                $lay->element('Spacer', array('height' => 28));
                $lay->container('TextLine');
                $lay->text($loc->getText('overdueGoodbye'));
                $lay->close();
                $lay->element('Spacer', array('height' => 14));
                $lay->container('TextLine');
                $lay->text($loc->getText('overdueTheStaffAt') . OBIB_LIBRARY_NAME);
                $lay->close();
                $lay->element('Spacer', array('height' => 14));
                $lay->pushFont('Times-Italic', 12);
                $lay->container('Line');
                $lay->container('TextLine', array('width' => '2in', 'underline' => 1));
                $lay->text($loc->getText('Title'));
                $lay->close();
                $lay->container('TextLine', array('width' => '1.5in', 'underline' => 1));
                $lay->text($loc->getText('Author'));
                $lay->close();
                $lay->container('TextLine', array('width' => '1in', 'underline' => 1));
                $lay->text($loc->getText('overdueDueDate'));
                $lay->close();
                $lay->container('TextLine', array('width' => '1.25in', 'underline' => 1));
                $lay->text($loc->getText('overdueDaysLate'));
                $lay->close();
                $lay->close();
                $lay->popFont();
            }
            $lay->container('Line');
            $lay->container('TextLine', array('width' => '2in'));
            $lay->text($row['title']);
            $lay->close();
            $lay->container('TextLine', array('width' => '1.5in'));
            $lay->text($row['author']);
            $lay->close();
            $lay->container('TextLine', array('width' => '1in'));
            $lay->text(date('m/d/y', strtotime($row['due_back_dt'])));
            $lay->close();
            $lay->container('TextLine', array('width' => '1.25in'));
            $lay->text($row['days_late']);
            $lay->close();
            $lay->close();
        }
        $lay->close();
        $lay->popFont();
        $lay->close();
    }
}

?>
