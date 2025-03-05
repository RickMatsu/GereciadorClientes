@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Criar Operadora</h2>
    <form action="{{ route('operadoras.store') }}" method="POST">
        @csrf @method('PUT')
        <br>        
        <div class="mb-3">
            <label>Nome da Operadora</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
