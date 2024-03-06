@extends('layouts.admin')

@section('content')

<div class="card m-3">
    <div class="card-header justify-content-between">
        <h3 class="card-title">Venda nº {{ $venda->id }}</h3>
        <div class="d-flex justify-content-between col-auto">
            <a href=" {{ route('venda.edit', ['venda' => $venda->id ]) }}" class="btn me-2 btn-secondary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                Editar
            </a>
            <form id="form_{{$venda->id}}" method="post" action="{{ route('venda.destroy', ['venda' => $venda->id]) }}">
                @method('DELETE')
                @csrf
                <!-- <button type="submit">Excluir</button>  -->
                <a href="#" onclick="document.getElementById('form_{{$venda->id}}').submit()" class="btn btn-danger w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                    Excluir cadastro
                </a>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Foto</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Valor unitário</th>
                  <th>Valor total unitário</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($venda->produtos as $p)
                  <tr>
                      <td>
                          <div class="form-control-plaintext">{{ $p->id }}</div>
                      </td>
                      <td>
                          <img src="{{ asset($p->foto) }}" alt="Ícone" width="77">
                      </td>
                      <td>
                          <div class="form-control-plaintext">{{ $p->nome }}</div>
                      </td>
                      <td>
                          <div class="form-control-plaintext">{{ $p->pivot->quantidade }}</div>
                      </td>

                      <td>
                          <div class="form-control-plaintext">{{ $p->valor }}</div>
                      </td>
                      <td>
                        <div class="form-control-plaintext">{{ $p->valor * $p->pivot->quantidade }}</div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
    </div>
    <div class="card-footer d-flex justify-content-center ">
        <div class="row g-3 mb-4 align-items-center">
            <div class="col">
                <div>
                    <label class="form-label">Qtde. Total</label>
                    <div class="fs-2">{{ $venda->quantidade_total }}</div>
                </div>
            </div>
            <div class="col">
                <div>
                    <label class="form-label">Valor Total</label>
                    <div class="fs-2">R$ {{ $venda->valor_total }}</div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection
