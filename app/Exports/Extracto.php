<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use App;


class Extracto implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $inicio;
    protected $fin;
    protected $moneda;

    public function __construct($inicio,$fin,$moneda)
    {
    	$this->inicio=$inicio;
    	$this->fin=$fin;
    	$this->moneda=$moneda;

    }
    public function collection()
    {
    	if($this->inicio!=0)
        	return DB::table('view_extracto_excel')->where('fech','>=',$this->inicio)->where('fech','<=',$this->fin)->where('moneda',$this->moneda)->get();
        else
            return DB::table('view_extracto_excel')->where('moneda',$this->moneda)->get();
    }
}
