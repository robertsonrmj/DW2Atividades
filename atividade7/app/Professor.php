<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public function disciplina(){
        return $this->hasOne('\App\Disciplina');
    } 
}
