@extends('layouts.admin')

@section('content')

<div class="col-12">
    <div class="card m-3">
        <div class="card-header justify-content-between">
            <h3 class="card-title">Lista de produtos</h3>
            <div>
                <a href="{{ route('produto.create') }}" class="btn btn-success w-100">
                    Adicionar novo produto
                </a>
            </div>
        </div>
      <div class="table-responsive m-4">
        <table class="display w-100" id="tabela-produtos">
          <thead>
            <tr>
              {{--<th class="w-1"></th>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"> --}}
              <th class="w-1">ID <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg>
              </th>
              <th>Foto</th>
              <th>Nome</th>
              <th>Categoria</th>
              <th>Quantidade</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($produtos as $p)
            <tr>
                <!--</td>  <input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"> -->
                <td><span class="text-muted">{{ $p->id }}</span></td>
                <td><img src="{{ asset($p->foto) }}" alt="Ícone" width="77"></td>
                <td>{{ $p->nome }}</td>
                <td>{{ $p->Categoria->nome }}</td>
                <td>{{ $p->quantidade }}</td>
                <td class="text-end">
                  <span class="dropdown">
                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Ações</button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('produto.show', ['produto' => $p]) }}">
                            Visualizar
                        </a>
                        <a class="dropdown-item" href="{{ route('produto.edit', ['produto' => $p->id]) }}">
                            Editar
                        </a>
                        <form id="form_{{$p->id}}" method="post" action="{{ route('produto.destroy', ['produto' => $p->id]) }}">
                            @method('DELETE')
                            @csrf
                            <!-- <button type="submit">Excluir</button>  -->
                            <a href="#" onclick="document.getElementById('form_{{$p->id}}').submit()" class="dropdown-item">
                                Excluir cadastro
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
        $('#tabela-produtos').DataTable({
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
