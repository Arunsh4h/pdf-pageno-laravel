<?php

namespace App\Http\Controllers;



use App\Http\Helpers\PDF;

use App\Item;

use Config;

use App\ItemDetail;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller

{

    public function uploadForm()

    {

        return view('upload_form');
    }

    public function uploadSubmit(Request $request)

    {

        $this->validate($request, [


            'pdffile' => 'required',

        ]);

        if ($request->hasFile('pdffile')) {

            $allowedfileExtension = ['pdf', 'docx'];

            $files = $request->file('pdffile');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

                //dd($check);

                if ($check) {


                    // initiate PDF
                    $pdf = new PDF();


                    // set the source file
                    // $pageCount = $pdf->setSourceFile($photo);

                    $pageCount = $pdf->setSourceFile($file->path());


                    $filename = $file->getClientOriginalName();




                    $savepath  = base_path() . '/upload/' . $filename;
                    //$savepath  = 'D:\xammp\laravel-8-pdf-page-numbering\upload\\'.$filename;
                    //$savepath  = Storage::url($filename);


                    $pdf->AliasNbPages();
                    for ($i = 1; $i <= $pageCount; $i++) {
                        //import a page then get the id and will be used in the template
                        $tplId = $pdf->importPage($i);
                        //create a page
                        $pdf->AddPage();
                        //use the template of the imporated page
                        $pdf->useTemplate($tplId);
                    }

                    //$pdf->Output();
                    //$pdf->Output($savepath,'F');
                    $pdf->Output('F', $savepath);

                    //echo public_path();
                    $opurl =  Config::get('app.url') . '/upload/' . $filename;
                    echo 'Added  Successfully you can <a href="' . $opurl . '" target="_blank" > Download </a> file here </br>';

                    //}


                    //echo 'Added  Successfully you can <a href="'.$opurl.'" target="_blank" > Download </a> file here </br>';

                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload pdf</div>';
                }
            }
        }
    }
}