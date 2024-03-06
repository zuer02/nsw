<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'foto', 'valor', 'categoria_id', 'quantidade'];

    public function Categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
    public function vendas(){
        return $this->belongsToMany('App\Models\Venda', 'produto_venda');
    }
}

