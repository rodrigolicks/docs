<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id'
    ];

    public function revisoes() {
        return $this->hasMany('App\Revisao');
    }
    
    public function categoria() {
        return $this->belongsTo('App\Categoria');
    }       
    /*
    public function documento_revisoes() {
        return $this->hasMany('App\DocumentoRevisoes');
    }
    */
}
