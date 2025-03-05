@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bem-Vindo') . ' ' . Auth::user()->name . '!!' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Este e seu gerenciador de Clientes/Operadoras de plano de saúde') }}

                    <!-- Botões para criação de Cliente e Operadora -->
                    <div class="mt-3">
                        <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm">Criar Cliente</a>
                        <a href="{{ route('operadoras.create') }}" class="btn btn-secondary btn-sm">Criar Operadora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF/CNPJ</th>
                            <th>Nome da Empresa</th>
                            <th>Numero de Vidas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->cpf ?? $cliente->cnpj }}</td>
                                <td>{{ $cliente->nome_empresa }}</td>
                                <td>{{ $cliente->numero_vidas }}</td>
                                <td>{{ $cliente->statusCliente->status_nome }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mb-2 me-2">
                    <a href="{{ route('clientes.index') }}" class="btn btn-primary">Ver todos os clientes</a>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection
