<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['valor_total', 'quantidade_total'];

    public function produtos(){
        return $this->belongsToMany('App\Models\Produto', 'produto_venda')->withPivot('quantidade');
    }
}
