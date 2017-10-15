<?php
define('IN_CB', true);
include('header.php');

$keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

$n = $table->numRows();
$table->insertRows($n, 3);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n + 1, 0, 'Keys');
$text2display = '';
$c = count($keys);
for($i = 0; $i < $c; $i++) {
	$text2display .= '<input type="button" value="' . $keys[$i] . '" style="width:25px;padding:0px;" onclick="newkey(this.form,\'' . $keys[$i] . '\')" /> ';
}
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Explanation');
$table->setText($n + 2, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>ISBN stands for International Standard Book Number.</li><li>ISBN type is based on EAN-13.</li><li>Previously, all ISBN were in EAN-10 format. EAN-13 uses the same encoding but may contain different data in the ISBN number.</li><li>Composed by a GS1 prefix (for ISBN-13), a group identifier, a publisher code, an item number and a check digit.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>