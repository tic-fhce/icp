<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
  protected $fillable = [
    'id_estudiante','id_curso','sigla','notaFinal',
];
}