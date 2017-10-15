<?php
define('IN_CB', true);
include('header.php');

$vals = array();
for($i = 0; $i <= 127; $i++) {
	$vals[] = '%' . sprintf('%02X', $i);
}
$keys = array(
	'NUL', 'SOH', 'STX', 'ETX', 'EOT', 'ENQ', 'ACK', 'BEL', 'BS', 'TAB', 'LF', 'VT', 'FF', 'CR', 'SO', 'SI', 'DLE', 'DC1', 'DC2', 'DC3', 'DC4', 'NAK', 'SYN', 'ETB', 'CAN', 'EM', 'SUB', 'ESC', 'FS', 'GS', 'RS', 'US',
	' ', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '*', '+', ',', '-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '<', '=', '>', '?',
	'@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', '\\', ']', '^', '_',
	'`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~', 'DEL'
);
if($a2 === '') {
	$a2 = 'NULL';
}
$n = $table->numRows();
$table->insertRows($n, 4);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n + 1, 0, 'Starts With');
$text2display = '<select size="1" name="a2"><option value="NULL"';
if($a2=='NULL') {
	$text2display .= ' selected="selected"';
}
$text2display .= '>Auto</option><option value="A"';
if($a2 === 'A') {
	$text2display .= ' selected="selected"';
}
$text2display .= '>Code 128-A</option><option value="B"';
if($a2 === 'B') {
	$text2display .= ' selected="selected"';
}
$text2display .= '>Code 128-B</option><option value="C"';
if($a2 === 'C') {
	$text2display .= ' selected="selected"';
}
$text2display .= '>Code 128-C</option></select>';
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Keys');
$text2display = '';
$c = count($keys);
for($i = 0; $i < $c; $i++) {
	$text2display .= '<input type="button" value="' . htmlentities($keys[$i]) . '" style="width:37px;padding:0px;" onclick="newkey(this.form,unescape(\'' . $vals[$i] . '\'))" /> ';
}
$table->setText($n + 2, 1, $text2display);
$table->setText($n + 3, 0, 'Explanation');
$table->setText($n + 3, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Code 128 is a high-density alphanumeric symbology.</li><li>Used extensively worldwide.</li><li>Code 128 is designed to encode 128 full ASCII characters.</li><li>The symbology includes a checksum digit.</li><li>Code 128A handles capital letters<br />Code 128B handles capital letters and lowercase<br />Code 128C handles group of 2 numbers</li><li>Your browser may not be able to write the special characters (NUL, SOH, etc.) but you can write them with the code.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>