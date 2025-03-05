@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Operadora</h2>
    <p><strong>Nome:</strong> {{ $operadora->nome }}</p>    
    <a href="{{ route('operadoras.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
