@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Atualizar cadastro de categoria</h3>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('categoria.update', ['categoria' => $categoria]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-4">
        <div class="col-md">
            <div class="mb-3">
                <label class="col-3 col-form-label required">Nome</label>
                <div class="col">
                    <input type="text" class="form-control" name="nome" id="nome" value="{{ $categoria->nome }}">
                    <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="mb-3">
                <label class="col-form-label required">Ícone</label>
                <input id="icone" name="icone" type="file" class="form-control" value="{{ $categoria->icone }}" />
                <span class="{{ $errors->has('icone') ? 'text-danger' : '' }}">
                    {{ $errors->has('icone') ? $errors->first('icone') : '' }}
                </span>
                <small class="form-hint">
                    o ícone deve ser em .svg, .png ou .ico, com até 512 kb.
                </small>
            </div>
        </div>
        </div>
        <div class="row g-3 mb-4">
        <div class="col-md">
        <div class="mb-3">
          <label class="col-3 col-form-label required">Descrição</label>
          <div class="col">
            <textarea class="form-control" rows="6" name="descricao" id="descricao">{{ $categoria->descricao }}</textarea>
            <span class="{{ $errors->has('descricao') ? 'text-danger' : '' }}">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
                </span>
          </div>
        </div>
        </div>
        </div>
      </div>
      <div class="card-footer text-end">
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Cadastrar
        </button>
      </div>
    </form>
  </div>
</div>
</div>
@endsection

