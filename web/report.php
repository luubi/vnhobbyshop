<div style="display:none">
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
$id=$_GET['id'];
if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');
define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
/** Include PHPExcel */

require_once '../PHPExcel-develop/Classes/PHPExcel.php';
$i=2;
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

							 
$objPHPExcel->getProperties()->setCreator("VN Hobby SHop")
							 ->setLastModifiedBy("VN Hobby SHop")
							 ->setTitle("Thống kê sản phẩm")
							 ->setSubject("Thống kê sản phẩm")
							 ->setDescription("Thống kê sản phẩm")
							 ->setKeywords("Thống kê sản phẩm")
							 ->setCategory("Thống kê sản phẩm");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Họ Tên')
			->setCellValue('C1', 'Số Điện Thoại')
			->setCellValue('D1', 'Ngày Tháng')
			->setCellValue('E1', 'Link')
			->setCellValue('F1', 'Số Lượng')
			->setCellValue('G1', 'Khối Lượng')
			->setCellValue('H1', 'Giá')
			->setCellValue('I1', 'Tổng Giá');
$con = mysqli_connect('localhost', 'vnhobby_vmlyme', '11092507', 'vnhobby_vnhobbyship');
mysqli_set_charset($con,'utf8');
$kq=mysqli_query($con,"select * from ship where ID='$id' order by ID desc");
while($row=mysqli_fetch_array($kq))
{
	$thoigian=substr($row['time'],8,2)."/".substr($row['time'],5,2)."/".substr($row['time'],2,2);
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $row['ID'])
            ->setCellValue('B'.$i, $row['name'])
			->setCellValue('C'.$i, $row['phone'])
			->setCellValue('D'.$i, $thoigian);
	$quantitys=explode(" ",$row['quantity']);
	$tok = strtok($row['link'], " \n\t");
	$sum="";
	$j=1;
	while ($tok !== false) {
		$url=$tok;
		$content = file_get_contents($url);
		$first_step = explode( '<span id="pweight" style="margin:0;font-size: 16px;width:50%; padding-top:15px">' , $content);
		$wei = explode("</span>" , $first_step[1] );
		$first_step1 = explode( '<span style="font-size: 38px;font-weight:bold; color:#ff6600;" itemprop="price" id="price_lb">'  , $content);
		$cos = explode("</span>" , $first_step1[1] );
		
		$sum+=substr($cos[0], 1)*$quantitys[$j];
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E'.$i, $tok)
			->setCellValue('F'.$i, $quantitys[$j])
            ->setCellValue('G'.$i, $wei[0].' /1')
			->setCellValue('H'.$i, $cos[0].' /1');
		$i++;
		$j++;
		$tok = strtok(" \n\t");
		}
	$i--;
	$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('I'.$i, '$'.$sum);
			$i++;

}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Product');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

/*
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="thongkedathang.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
*/

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xlsx', __FILE__));

var_dump($objPHPExcel->getActiveSheet()->toArray());


echo '<script type="text/javascript">
			   window.location.replace("mail.php");
			</script>';
			
exit;
?>
</div>