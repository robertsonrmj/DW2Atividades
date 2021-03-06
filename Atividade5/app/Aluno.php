<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
   public function disciplina(){
       return $this->belongsToMany('\App\Disciplina', 'matriculas');
   }

   public function curso(){
    return $this->belongsTo('\App\Curso');
}
}
