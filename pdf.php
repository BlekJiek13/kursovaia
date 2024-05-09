<?php 
session_start();

include  '/www/wwwroot/boostrap.local/app/db.php';
require_once './dompdf/autoload.inc.php';


use Dompdf\Dompdf;

$dompdf = new Dompdf();



if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price_pdf'])){

	$filename = "Price MyCourse";
	ob_start();
	require('price_pdf.php');
	$htmlContent = ob_get_clean();	
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_pdf'])){

	$filename = "Order ". $_SESSION['login'];
	ob_start();
	require('order_pdf.php');
	$htmlContent = ob_get_clean();	
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otchet_pdf'])){

	
	$filename = "Report ";
	ob_start();
	require('report_pdf.php');
	$htmlContent = ob_get_clean();	
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_pdf'])){

	
	$filename = "Search ";
	ob_start();
	require('search_pdf.php');
	$htmlContent = ob_get_clean();	
}


$dompdf->loadHtml($htmlContent);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($filename);

?>