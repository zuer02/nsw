<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoVenda;
use App\Models\Venda;
use Illuminate\Http\Request;
use App\Http\Requests\VendaRequest;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = Venda::all();

        return view('venda.index', ['vendas' => $vendas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produtos = Produto::where('quantidade', '>', 0)->get();
        return view('venda.create', ['produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendaRequest $request)
    {
        $valorTotal = 0;
        foreach ($request->input('produto_id') as $index => $produtoId) {
            $produto = Produto::find($produtoId);
            $valorTotal += ($request->input('quantidade_produto')[$index] * $produto->valor);
        }

        $venda = Venda::create([
            'valor_total' => $valorTotal,
            'quantidade_total' => array_sum($request->input('quantidade_produto'))
        ]);
        foreach ($request->input('produto_id') as $index => $produtoId) {
            $quantidadeProduto = $request->input('quantidade_produto')[$index];
            $produto = Produto::find($produtoId);
            $produto->quantidade -= $request->input('quantidade_produto')[$index];
            // dd($quantidadeProduto);

            $produto->save();
            if ($quantidadeProduto > 0) {
                ProdutoVenda::create([
                    'produto_id' => $produtoId,
                    'quantidade' => $quantidadeProduto,
                    'venda_id' => $venda->id
                ]);
            }
        }
        return redirect()->route('venda.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venda $venda)
    {
        return view('venda.show', ['venda' => $venda]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $venda)
    {
        $produtos = Produto::whereNotIn('id', $venda->produtos->pluck('id'))
            ->where('quantidade', '>', 0)
            ->get();
        // dd($produtos);
        return view('venda.edit', ['venda' => $venda, 'produtos' => $produtos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendaRequest $request, Venda $venda)
    {
        $valorTotal = 0;
        foreach ($request->input('produto_id') as $index => $produtoId) {
            $produto = Produto::find($produtoId);
            $valorTotal += ($request->input('quantidade_produto')[$index] * $produto->valor);
        }

        $venda->update([
            'valor_total' => $valorTotal,
            'quantidade_total' => array_sum($request->input('quantidade_produto'))
        ]);
        foreach ($request->input('produto_id') as $index => $produtoId) {
            $quantidadeProduto = $request->input('quantidade_produto')[$index];
            $produto = Produto::find($produtoId);
            $produto->quantidade -= $request->input('quantidade_produto')[$index];
            // dd($quantidadeProduto);

            $produto->save();
            if ($quantidadeProduto > 0) {
                if(ProdutoVenda::where('venda_id', $venda->id)->where('produto_id', $produto->id)->exists()){
                    $prod_venda = ProdutoVenda::where('venda_id', $venda->id)->where('produto_id', $produto->id);
                    $prod_venda->update([
                        'produto_id' => $produtoId,
                        'quantidade' => $quantidadeProduto,
                        'venda_id' => $venda->id
                    ]);

                } else{
                    $prod_vdd = ProdutoVenda::create([
                        'produto_id' => $produtoId,
                        'quantidade' => $quantidadeProduto,
                        'venda_id' => $venda->id
                    ]);
                    // dd($prod_vdd);
                }
            }
        }
        return redirect()->route('venda.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $venda)
    {
        ProdutoVenda::where('venda_id', $venda->id)->delete();
        $venda->delete();

        return redirect()->route('venda.index');
    }
}
