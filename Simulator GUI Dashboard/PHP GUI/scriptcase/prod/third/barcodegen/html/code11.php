<?php
define('IN_CB', true);
include('header.php');

$keys = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '-');

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
	$text2display .= '<input type="button" value="' . $keys[$i].'" style="width:25px;padding:0px;" onclick="newkey(this.form,\'' . $keys[$i] . '\')" /> ';
}
$table->setText($n + 1, 1, $text2display);
$table->setText($n + 2, 0, 'Explanation');
$table->setText($n + 2, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Known also as USD-8.</li><li>Code 11 was developed in 1977 as a high-density numeric symbology.</li><li>Used to identify telecommunications equipment.</li><li>Code 11 is a numeric symbology and its character set consists of 10 digital characters and the dash symbol (-).</li><li>There is a "C" check digit. If the length of encoded message is greater thant 10, a "K" check digit may be used.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>