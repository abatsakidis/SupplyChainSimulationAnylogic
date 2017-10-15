<?php
define('IN_CB', true);
include('header.php');

$n = $table->numRows();
$table->insertRows($n, 3);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n + 1, 0, 'Text Label');
$table->setText($n + 1, 1, '<input type="text" name="a3" value="' . $a3 . '" />');
$table->setText($n + 2, 0, 'Explanation');
$table->setText($n + 2, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Enter width of each bars with one characters. Begin by a bar.</li><li>10523 : Will do 2px bar, 1px space, 6px bar, 3px space, 4px bar.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>
