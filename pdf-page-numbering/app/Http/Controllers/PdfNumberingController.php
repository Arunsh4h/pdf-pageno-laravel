<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Helpers\PDF;
use Carbon\Carbon;
 
class PdfNumberingController extends Controller
{
    public function index() {
		
		ini_set('display_errors', 1);

       // initiate PDF
        $pdf = new PDF();
 
        // set the source file
        $pageCount = $pdf->setSourceFile("file:///D:/file-1.pdf.pdf");
		//$pageCount = $pdf->setSourceFile("file:///D:/file-1.pdf.pdf");
  
			$timestamp = now();
			$savepath  = "D:\xammp\laravel-8-pdf-page-numbering\upload\\".$timestamp;
        $pdf->AliasNbPages();
        for ($i=1; $i <= $pageCount; $i++) { 
            //import a page then get the id and will be used in the template
            $tplId = $pdf->importPage($i);
            //create a page
            $pdf->AddPage();
            //use the template of the imporated page
            $pdf->useTemplate($tplId);
        }
 
 
        //$pdf->Output();
		//$pdf->Output($savepath,'F');
		$pdf->Output('F','D:\xammp\laravel-8-pdf-page-numbering\upload/filename.pdf'); 
    }
}