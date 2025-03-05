@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Operadora</h2>
    <form action="{{ route('operadoras.update', $operadora) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nome da Operadora</label>
            <input type="text" name="nome" class="form-control" value="{{ $operadora->nome }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
