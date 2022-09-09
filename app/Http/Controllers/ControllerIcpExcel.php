<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\Extracto;

class ControllerIcpExcel extends Controller
{
    //
    public function exportexcel($inicio,$fin,$moneda){
    	return Excel::download(new Extracto($inicio,$fin,$moneda),'extracto.xlsx');
    }
}
