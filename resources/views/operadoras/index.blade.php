@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Operadoras</h2>
    <a href="{{ route('operadoras.create') }}" class="btn btn-primary">Adicionar Operadora</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>                
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($operadoras as $operadora)
                <tr>
                    <td>{{ $operadora->id }}</td>
                    <td>{{ $operadora->nome }}</td>
                    <td class="text-end">
                        <a href="{{ route('operadoras.show', $operadora) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('operadoras.edit', $operadora) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('operadoras.destroy', $operadora) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $operadoras->links() }}
</div>
@endsection
