<?php 
session_start();

include  '/www/wwwroot/boostrap.local/app/db.php';
require_once '../../dompdf/autoload.inc.php';


use Dompdf\Dompdf;
use FontLib\Table\Type\head;

$dompdf = new Dompdf();


function dompdf($dompdf,$htmlContent,$filename){
	$dompdf->loadHtml($htmlContent);
	$dompdf->setPaper('A4', 'landscape');
	$dompdf->render();
	$dompdf->stream($filename);
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['price_pdf'])){

	$filename = "Price MyCourse";
	ob_start();
	require('price_pdf.php');
	$htmlContent = ob_get_clean();	

	dompdf($dompdf,$htmlContent,$filename);
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_pdf'])){

	$filename = "Order ". $_SESSION['login'];
	ob_start();
	require('order_pdf.php');
	$htmlContent = ob_get_clean();	
	dompdf($dompdf,$htmlContent,$filename);
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otchet_pdf'])){

	
	$filename = "Report ";
	ob_start();
	require('../../report_pdf.php');
	$htmlContent = ob_get_clean();	
	dompdf($dompdf,$htmlContent,$filename);
}



if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chart'])){

	$mindate = "\"". mb_substr($_POST['date'],6,4). ".". mb_substr($_POST['date'],3,2) .".". mb_substr($_POST['date'],0,2). "\"" ;
	$maxdate = "\"". mb_substr($_POST['date'],19,4). ".". mb_substr($_POST['date'],16,2) .".". mb_substr($_POST['date'],13,2). "\"" ;


	$_SESSION['mindate'] = $mindate;
	$_SESSION['maxdate'] = $maxdate;
	header('location:../../google_chart/chart_otchet.php');
	exit();
}



if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_pdf'])){

	
	$filename = "Search ";
	ob_start();
	require('search_pdf.php');
	$htmlContent = ob_get_clean();	
	dompdf($dompdf,$htmlContent,$filename);
}



?>


