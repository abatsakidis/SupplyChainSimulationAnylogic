<?php
ob_start();
//$content 	='<h3>ANSWER DATA GRID </h3> ';
$content .= '<table border="0">';
$content .= '<tr>';
foreach($fields as $r )
{
	if($r['download'] =='1')
		$content .= '<th style="background:#f9f9f9;">'. $r['label'] . '</th>';
}
$content .= '</tr>';

foreach ($rows as $row)
{
	$content .= '<tr>';
	foreach($fields as $f )
	{
		if($f['download'] =='1')	$content .= '<td>'. $row[$f['field']] . '</td>';
	}
	$content .= '</tr>';
}
$content .= '</table>';

echo $content;
$html = ob_get_contents();
ob_end_clean();
$filename = $title.' '.date("d/m/Y");
$this->mpdf->WriteHTML($html);
$this->mpdf->Output($filename .'.pdf', 'D');
?>
