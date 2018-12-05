<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisao extends Model
{
    protected $table = 'revisoes';
    protected $fillable = ['nome', 'descricao'];

    public function documento() {
        return $this->belongsTo('App\Documento');
    }
}