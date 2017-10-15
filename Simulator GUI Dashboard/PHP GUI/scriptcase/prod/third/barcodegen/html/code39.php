<?php
define('IN_CB', true);
include('header.php');

$keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '-', '.', ' ', '$', '/', '+', '%');

$n = $table->numRows();
$table->insertRows($n, 4);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n + 1, 0, '<label for="checksum">Checksum</label>');
$text2display = '<input type="checkbox" name="a1" id="checksum" value="1"';
if($a1 == 1) {
	$text2display .= ' checked="checked"';
}
$text2display .= ' />';
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Keys');
$text2display = '';
$c = count($keys);
for($i = 0; $i < $c; $i++) {
	$text2display .= '<input type="button" value="' . $keys[$i] . '" style="width:25px;padding:0px;" onclick="newkey(this.form,\'' . $keys[$i] . '\')" /> ';
}
$table->setText($n + 2, 1, $text2display);
$table->setText($n + 3, 0, 'Explanation');
$table->setText($n + 3, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Known also as USS Code 39, 3 of 9.</li><li>Code 39 can encode alphanumeric characters.</li><li>The symbology is used in non-retail environment.</li><li>Code 39 is designed to encode 26 upper case letters, 10 digits and 7 special characters.</li><li>Code 39 has a checksum but it\'s rarely used.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>