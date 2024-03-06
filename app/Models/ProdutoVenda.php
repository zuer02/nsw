<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVenda extends Model
{
    use HasFactory;

    protected $table = 'produto_venda';

    protected $fillable = ['produto_id', 'venda_id', 'quantidade'];

    public function Produto(){
        return $this->belongsTo('App\Models\Produto');
    }
}
