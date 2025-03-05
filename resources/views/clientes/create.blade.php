@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Adicionar Cliente</h2>
    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>CPF/CNPJ</label>
            <input type="text" name="documento" class="form-control" required maxlength="14">
        </div>
        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Data de Recebimento</label>
            <input type="date" name="data_recebimento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nome da Empresa</label>
            <input type="text" name="nome_empresa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Numero de Vidas</label>
            <input type="text" name="numero_vidas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Operadora</label>
            <select name="operadora" class="form-control" required>
                <option value="">Selecione uma operadora</option>
            @foreach($operadoras as $operadora)
                <option value="{{ $operadora->id }}">{{ $operadora->nome }}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Selecione o Status</option>
                @foreach($status as $stat)
                    <option value="{{ $stat->id }}">{{ $stat->status_nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Valor da Proposta</label>
            <input type="text" id="valor" name="valor" class="form-control" required>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/inputmask.min.js"></script>
            <script>
            Inputmask('currency', { radixPoint: ',' }).mask(document.getElementById('valor'));
            </script>
        </div>
        <div class="mb-3">
            <label>Numero da Proposta</label>
            <input type="number" name="numero_proposta" class="form-control">
        </div>
        <div class="mb-3">
            <label>Observação</label>
            <input type="text" name="observacao" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
