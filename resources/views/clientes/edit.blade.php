@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cliente</h2>
    <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $cliente->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $cliente->email }}" required>
        </div>

        <div class="mb-3">
            <label>CPF/CNPJ</label>
            <input type="text" name="documento" class="form-control" value="{{ $cliente->documento }}" required maxlength="14">
        </div>

        <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" class="form-control" value="{{ $cliente->data_nascimento }}" required>
        </div>

        <div class="mb-3">
            <label>Data de Recebimento</label>
            <input type="date" name="data_recebimento" class="form-control" value="{{ $cliente->data_recebimento }}" required>
        </div>

        <div class="mb-3">
            <label>Nome da Empresa</label>
            <input type="text" name="nome_empresa" class="form-control" value="{{ $cliente->nome_empresa }}" required>
        </div>

        <div class="mb-3">
            <label>Operadora</label>
            <select name="operadora" class="form-control" required>
                <option value="">Selecione uma operadora</option>
                @foreach($operadoras as $operadora)
                    <option value="{{ $operadora->id }}" 
                        {{ $cliente->operadora_id == $operadora->id ? 'selected' : '' }}>
                        {{ $operadora->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Selecione o Status</option>
                @foreach($status as $stat)
                    <option value="{{ $stat->id }}" 
                        {{ $cliente->status_id == $stat->id ? 'selected' : '' }}>
                        {{ $stat->status_nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Valor da Proposta</label>
            <input type="text" id="valor" name="valor" class="form-control" value="{{ $cliente->valor }}" required>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/inputmask.min.js"></script>
            <script>
                Inputmask('currency', { radixPoint: ',' }).mask(document.getElementById('valor'));
            </script>
        </div>

        <div class="mb-3">
            <label>Número da Proposta</label>
            <input type="number" name="numero_proposta" class="form-control" value="{{ $cliente->numero_proposta }}">
        </div>

        <div class="mb-3">
            <label>Observação</label>
            <input type="text" name="observacao" class="form-control" value="{{ $cliente->observacao }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
    </form>
</div>
@endsection
