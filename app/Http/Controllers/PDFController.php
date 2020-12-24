<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    //dynamic pdf
    public function index()
    {
        $data = $this->get_data();
        return view('dynamic_pdf.index')->with('data',$data);
    }

    public function get_data()
    {
        $data = DB::table('servers')->limit(25)->get();
        return $data;
    }

    public function PDF()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_data_to_html());
        $pdf->stream();
    }

    public function convert_data_to_html()
    {
        $data = $this->get_data();
        $output = '<h1>Server Data</h1>
        <div class="servers">
        <table class="table table-striped">
            <thead>
                <tr>
                  <th>Server Naam</th>
                  <th>Server Type</th>
                  <th>Server OTAP</th>
                </tr>
            </thead>
            <tbody>';
            foreach($data as $server_data){
                $output .= '<tr><td>' . $server_data->server_name . '</td><td>' . $server_data->server_type . '</td><td>' .$server_data->server_otap . '</td></tr>'; 
            }
        $output .= '</tbody>
        </table>
        </div>';

        return $output;
    }
}