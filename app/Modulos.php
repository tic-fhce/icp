<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
  protected $fillable = [
    'sigla','nombre','id_curso','id_docente',
];
}