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

$n = $table->numRows();
$table->insertRows($n, 4);
$table->addRowAttribute($n, 'class', 'table_title');
$table->addCellAttribute($n, 0, 'align', 'center');
$table->addCellAttribute($n, 0, 'colspan', '2');
$table->setText($n, 0, '<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n + 1, 0, '<label for="checksum">Checksum</label>');
$text2display = '<input type="checkbox" name="a1" id="checksum" value="1"';
if($a1==1) {
	$text2display .= ' checked="checked"';
}
$text2display .= ' />';
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Keys');
$text2display = '';
$c = count($keys);
for($i = 0; $i < $c; $i++) {
	$text2display .= '<input type="button" value="' . htmlentities($keys[$i]) . '" style="width:37px;padding:0px;" onclick="newkey(this.form,unescape(\'' . $vals[$i] . '\'))" /> ';
}
$table->setText($n + 2, 1, $text2display);
$table->setText($n + 3, 0, 'Explanation');
$table->setText($n + 3, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Supports the ASCII 0 to 127</li><li>This mode is "optional" for Code 39, you have to specify your reader that you have extended code.</li><li>Your browser may not be able to write the special characters (NUL, SOH, etc.) but you can write them with the code.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>