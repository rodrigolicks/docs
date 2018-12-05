<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentoRevisoes extends Model
{
    protected $fillable = ['historico_id', 'habito_id'];

    public function revisao() {
        return $this->belongsTo('App\Revisao');
    }
}
