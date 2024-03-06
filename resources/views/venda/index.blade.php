@extends('layouts.admin')

@section('content')

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de Vendas</h3>
            <div>
                <a href="{{ route('venda.create') }}" class="btn btn-success w-100">
                    Adicionar nova venda
                </a>
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-vendas">
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Produtos</th>
              <th>Quantidade</th>
              <th>Valor unitário</th>
              <th>Quantidade total</th>
              <th>Valor total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($vendas as $v)
            <tr>
                <!--</td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $v->id }}</span></td>
                <td>
                    @foreach ($v->produtos as $vp)
                        {{ $vp->nome }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($v->produtos as $vp)
                        {{ $vp->pivot->quantidade }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($v->produtos as $vp)
                        {{ $vp->valor }}<br>
                    @endforeach
                </td>
                <td>{{ $v->quantidade_total }}</td>
                <td>{{ $v->valor_total }}</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('venda.show', ['venda' => $v]) }}">
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="{{ route('venda.edit', ['venda' => $v->id]) }}">
                            Editar
                        </a>
                        <form id="form_{{$v->id}}" method="post" action="{{ route('venda.destroy', ['venda' => $v]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$v->id}}').submit()" class="dropdown-item">
                                Excluir
                            </a>
                        </form>
                    </div>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready( function () {
        $('#tabela-vendas').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "pageLength": 10,
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            },
        });
    });
</script>
@endsection
