<?php

namespace App\Http\Controllers;

use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PDFcontroller extends Controller
{
    //
    public function download(Request $request){
     
        $order_id = $request->query('order_id');
       
        $html = view('Invoice.invoice', [
            'order_id' => $order_id,
        ])->render();
        
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [10, 10, 10, 10]);
        $html2pdf->writeHTML($html, false);
        $html2pdf->output('file.pdf');
    }
}
