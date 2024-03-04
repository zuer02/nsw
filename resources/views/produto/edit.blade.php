@extends('layouts.admin')

@section('content')
<div class="card m-3">
    <div class="card-header">
      <h3 class="card-title">Cadastro de Produto</h3>
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('produto.update', ['produto' => $produto]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3 mb-4">
        <div class="col-md">
            <div class="mb-3">
                <label class="col-3 col-form-label required">Nome</label>
                <div class="col">
                    <input type="text" class="form-control" name="nome" id="nome" value="{{ $produto->nome }}">
                    <span class="{{ $errors->has('nome') ? 'text-danger' : '' }}">
                        {{ $errors->has('nome') ? $errors->first('nome') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="mb-3">
                <label class="col-form-label required">Foto</label>
                <input id="foto" name="foto" type="file" class="form-control" />
                <span class="{{ $errors->has('foto') ? 'text-danger' : '' }}">
                    {{ $errors->has('foto') ? $errors->first('foto') : '' }}
                </span>
                <small class="form-hint">
                    o ícone deve ser em .jpg, .png ou .jpeg, com até 2 MB.
                </small>
            </div>
        </div>
        </div>
        <div class="row g-3 mb-4">
        <div class="col-md">
            <div class="mb-3">
            <label class="col-3 col-form-label required">Categoria</label>
            <select class="form-select" name="categoria_id" id="categoria_id">
                <option value=""> -- Selecione a categoria -- </option>
                @foreach($categorias as $c)
                    <option value="{{ $c->id }}" {{ $produto->categoria_id ?? old('categoria_id') == $c->id ? 'selected' : '' }}>
                        {{ $c->nome }}
                    </option>
                @endforeach
            </select>
            <span class="{{ $errors->has('categoria_id') ? 'text-danger' : '' }}">
                {{ $errors->has('categoria_id') ? $errors->first('categoria_id') : '' }}
            </span>
            </div>
        </div>
        <div class="col-md">
            <div class="mb-3">
                <label class="col-3 col-form-label required">Quantidade</label>
                <div class="col">
                    <input type="number" class="form-control" name="quantidade" id="quantidade" value="{{ $produto->quantidade }}">
                    <span class="{{ $errors->has('quantidade') ? 'text-danger' : '' }}">
                        {{ $errors->has('quantidade') ? $errors->first('quantidade') : '' }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="mb-3">
                <label class="col-3 col-form-label required">Valor</label>
                <div class="col">
                    <input type="text" class="form-control" name="valor" id="valor" value="{{ $produto->valor }}">
                    <span class="{{ $errors->has('valor') ? 'text-danger' : '' }}">
                        {{ $errors->has('valor') ? $errors->first('valor') : '' }}
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

