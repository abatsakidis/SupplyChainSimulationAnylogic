<?php
if(!defined('IN_CB')) die('You are not allowed to access to this page.');

/**
 * Displays Select Code bar Box
 *
 * @param string $filename
 */
function display_select($filename) {
	$table_value = array('codabar', 'code11', 'code39', 'code39extended', 'code93', 'code128', 'ean8', 'ean13', 'gs1128', 'isbn', 'i25', 's25', 'msi', 'upca', 'upce', 'upcext2', 'upcext5', 'postnet', 'othercode');
	$table_text = array('Codabar', 'Code 11', 'Code 39', 'Code 39 Extended', 'Code 93', 'Code 128', 'EAN-8', 'EAN-13', 'GS1-128 (EAN-128)', 'ISBN-10 / ISBN-13', 'Interleaved 2 of 5', 'Standard 2 of 5', 'MSI Plessey', 'UPC-A', 'UPC-E', 'UPC Extension 2 Digits', 'UPC Extension 5 Digits', 'PostNet', 'Other Barcode');
	$text2display = '';
	$text2display .= '<select name="barcode_type" size="1" onchange="location.href=barcode_type.options[barcode_type.selectedIndex].value + \'.php\'" style="width: 300px">';
	$c = count($table_value);
	for ($i = 0; $i < $c; $i++) {
		$text2display .= '<option value="' . $table_value[$i] . '"';
		if ($table_value[$i] === $filename) {
			$text2display .= ' selected="selected"';
		}
		$text2display .= '>' . $table_text[$i] . '</option>';
	}
	$text2display .= '</select>';
	return $text2display;
}

/**
 * Displays the output (PNG, JPEG, GIF)
 *
 * @param int $number
 */
function display_output($number) {
	$table_value = array('1', '2', '3');
	$table_text = array('Portable Network Graphics (PNG)', 'Joint Photographic Experts Group (JPEG)', 'Graphics Interchange Format (GIF)');
	$text2display = '';
	$text2display .= '<select onchange="if(this.value==1||this.value==2)disableDPI(false);else disableDPI(true);" name="output" size="1" style="width:300px">';
	$c = count($table_value);
	for ($i = 0; $i < $c; $i++) {
		$text2display .= '<option value="' . $table_value[$i] . '"';
		if (intval($table_value[$i]) === intval($number)) {
			$text2display .= ' selected="selected"';
		}
		$text2display .= '>' . $table_text[$i] . '</option>';
	}
	$text2display .= '</select>';
	return $text2display;
}

/**
 * Displays the DPI
 *
 * @param int $output
 * @param float $dpi
 */
function display_dpi($output, $dpi) {
	$disabled = ($output != 1 && $output != 2);
	$disableText = $disabled ? ' disabled="disabled"' : '';
	$showExplain = $disabled ? '' : ' display: none;';

	return '<script type="text/javascript">
function disableDPI(disable){
	document.getElementById("dpi").disabled = disable;
	document.getElementById("dpi_explain").style.display = disable ? "inline" : "none";
}
</script><input type="text" id="dpi" name="dpi" value="' . $dpi . '" size="5"' . $disableText . ' /> <span id="dpi_explain" style="color: red;' . $showExplain . '">DPI is available only for PNG and JPEG.</span><div style="font-size: 8pt;">If you set <i>null</i>, the image generation will be faster and will be the same as 72dpi.</div>';
}

/**
 * Displays the thickness of the bars
 *
 * @param int $number
 */
function display_thickness($number) {
	return '<input type="text" name="thickness" value="' . $number . '" size="5" />';
}

/**
 * Displays the resolution of the code
 *
 * @param int $number
 */
function display_res($number) {
	$table = new LSTable(1, 3, '100%', $null);
	$table->setTemplate('tpl_BLANK');
	for ($i = 1; $i <= 3; $i++) {
		$text2display = '';
		$text2display .= '<input type="radio" id="res' . $i . '" name="res" value="' . $i . '"';
		if ($number === $i) {
			$text2display .= ' checked="checked"';
		}
		$text2display .= ' /> <label for="res' . $i . '">' . $i . '</label>';
		$table->setText(0, $i - 1, $text2display);
	}
	return $table;
}

/**
 * Displays the rotation
 *
 * @param int $rotation
 */
function display_rotation($rotation) {
	$availableRotation = array(0, 90, 180, 270);
	$c = count($availableRotation);
	$table = new LSTable(1, $c, '100%', $null);
	$table->setTemplate('tpl_BLANK');
	for ($i = 0; $i < $c; $i++) {
		$text2display = '';
		$text2display .= '<input type="radio" id="rotation' . $i . '" name="rotation" value="' . $availableRotation[$i] . '"';
		if ($rotation == $availableRotation[$i]) {
			$text2display .= ' checked="checked"';
		}
		$text2display .= ' /> <label for="rotation' . $i . '">' . $availableRotation[$i] . '&deg;</label>';
		$table->setText(0, $i, $text2display);
	}
	return $table;
}

/**
 * Displays the fontsize of the label
 *
 * @param int $number
 */
function display_font($family, $size) {
	if($family === '0') $family = 'Arial.ttf';
	$text2display = '';
	$text2display .= '<select name="font_family" size="1" style="width:130px">';
	$text2display .= '<option value="-1">No Text</option>';
	// List of all fonts available
	$f = listfonts();
	$c = count($f);
	for ($i = 0; $i < $c; $i++) {
		$text2display .= '<option value="' . $f[$i] . '"';
		if ($f[$i] === $family) {
			$text2display .= ' selected="selected"';
		}
		$text2display .= '>' . $f[$i] . '</option>';
	}
	$text2display .= '</select>';
	$text2display .= ' ';
	$text2display .= '<input type="text" name="font_size" value="' . $size . '" size="3" style="width:30px" />';
	return $text2display;
}

/**
 * Displays the textbox
 *
 * @param string $text
 */
function display_text($text) {
	return '<input type="text" name="text2display" value="' . $text . '" size="20" />';
}

/**
 * Returns the next class for a table line.
 *
 * @param int $restart If 1, then restart color to 1
 * @return string
 */
function next_color($restart = 0) {
	global $sys_conf;
	static $color = 0;
	if ($restart === 1) { $color = NULL; }
	if ($color === 1) { $couleur = 'row2'; $color = 2; }
	else { $couleur = 'row1'; $color = 1; }
	return $couleur;
}

/**
 * Returns the font available for drawing
 *
 * @return string[]
 */
function listfonts() {
	global $class_dir;

	$array = array();
	if (($handle = opendir($class_dir . '/font')) !== false) {
		while (($file = readdir($handle)) !== false) {
			if(substr($file, -4, 4) === '.ttf') {
				$array[] = $file;
			}
		}
	}
	closedir($handle);

	return $array;
}
?>