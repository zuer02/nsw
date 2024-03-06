@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
        <div class="d-flex justify-content-between col-auto">
            <h3 class="card-title">Atualizar cadastro de venda</h3>
        </div>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('venda.update', ['venda' => $venda]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="table-responsive">
          <table class="table mb-3">
            <thead>
              <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Produto</th>
                <th>Quantidade disponível</th>
                <th>Quantidade</th>
                <th>Valor unitário</th>
                <th>Valor total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($venda->produtos as $p)
                <tr>
                    <td>
                        <input type="hidden" id="produto_id" name="produto_id[]" class="form-control-plaintext" readonly value="{{ $p->id }}">
                        <div class="form-control-plaintext">{{ $p->id }}</div>
                    </td>
                    <td>
                        <img src="{{ asset($p->foto) }}" alt="Ícone" width="77">
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->nome }}</div>
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->quantidade }}</div>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="quantidade_produto[]" id="quantidade_{{ $p->id }}" min="0" max="{{ $p->quantidade }}" onchange="atualizarValorTotal(this.value, {{ $p->valor }}, {{ $p->id }})" value="{{ $p->pivot->quantidade }}">
                        <span class="{{ $errors->has('quantidade') ? 'text-danger' : '' }}">
                            {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                        </span>
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->valor }}</div>
                    </td>
                    <td>
                        <input type="number" id="valor_{{ $p->id }}" name="valor_total" class="form-control" readonly value="{{ $venda->valor_total }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          @if ($produtos->isNotEmpty())
          <h3 class="card-title">Adicionar produtos</h3>
          <table class="table mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Produto</th>
                <th>Quantidade disponível</th>
                <th>Quantidade</th>
                <th>Valor unitário</th>
                <th>Valor total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $p)
                <tr>
                    <td>
                        <input type="hidden" id="produto_id" name="produto_id[]" class="form-control-plaintext" readonly value="{{ $p->id }}">
                        <div class="form-control-plaintext">{{ $p->id }}</div>
                    </td>
                    <td>
                        <img src="{{ asset($p->foto) }}" alt="Ícone" width="77">
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->nome }}</div>
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->quantidade }}</div>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="quantidade_produto[]" id="quantidade_{{ $p->id }}" min="0" max="{{ $p->quantidade }}" onchange="atualizarValorTotal(this.value, {{ $p->valor }}, {{ $p->id }})" value="0">
                        <span class="{{ $errors->has('quantidade') ? 'text-danger' : '' }}">
                            {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                        </span>
                    </td>
                    <td>
                        <div class="form-control-plaintext">{{ $p->valor }}</div>
                    </td>
                    <td>
                        <input type="number" id="valor_{{ $p->id }}" name="valor_total" class="form-control" readonly value="{{ $venda->valor_total }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
      <div class="card-footer d-flex justify-content-end ">
        <button type="submit" class="btn btn-primary mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Cadastrar
        </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
@endsection

@section('js')
<script>
let qtdeTotal = 0;
let valorTotalGeral = 0;
let quantidade_anterior = 0;

function atualizarValorTotal(quantidade, valor, id) {
    let valor_total_unit = document.getElementById("valor_" + id);

    quantidade = parseInt(quantidade);
    let diferenca = quantidade - quantidade_anterior;
    quantidade_anterior = quantidade;

    var conta = quantidade * valor;
    valor_total_unit.value = conta.toFixed(2);

}
</script>
@endsection
