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
$table->setText($n + 2, 1, '<ul style="margin: 0px; padding-left: 25px;"><li>Encoded as EAN-13.</li><li>Most common and well-known in the USA.</li><li>There is 1 number system (NS), 5 manufacturer code, 5 product code and 1 check digit.</li><li>NS Description :<br />0 = Regular UPC Code<br />2 = Weight Items<br />3 = Drug/Health Items<br />4 = In-Store Use on Non-Food Items<br />5 = Coupons<br />7 = Regular UPC Code<br />And other are Reserved.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>