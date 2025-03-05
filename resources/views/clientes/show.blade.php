@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes do Cliente</h2>
    <p><strong>Nome:</strong> {{ $cliente->nome }}</p>
    <p><strong>Email:</strong> {{ $cliente->email }}</p>
    <p><strong>CPF/CNPJ:</strong> {{ $cliente->cpf ?? $cliente->cnpj  }}</p>
    <p><strong>Data de Nascimento:</strong> {{ $cliente->data_nascimento }}</p>
    <p><strong>Data de Recebimento:</strong> {{ $cliente->data_recebimento }}</p>
    <p><strong>Nome da Empresa:</strong> {{ $cliente->nome_empresa }}</p>
    <p><strong>Número de Vidas:</strong> {{ $cliente->numero_vidas }}</p>
    <p><strong>Operadora:</strong> {{$cliente->operadora ? $cliente->operadora->nome : 'Sem operadora' }}</p>
    <p><strong>Status:</strong> {{ $cliente->statusCliente->status_nome }}</p>
    <p><strong>Valor da Proposta: R$:</strong> {{ $cliente->valor }}</p>
    <p><strong>Numero da Proposta:</strong> {{ $cliente->numero_proposta }}</p>
    <p><strong>Observação:</strong> {{ $cliente->observacao }}</p>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
