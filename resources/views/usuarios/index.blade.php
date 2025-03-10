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

                    {{ __('Este e seu gerenciador de Usuarios') }}

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
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if($usuario->is_online == 1)
                                        <i class="bi bi-toggle-on" style="color: green;"></i> <!-- Online -->
                                    @else
                                        <i class="bi bi-toggle-off" style="color: red;"></i> <!-- Offline -->
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>           
            </div>
        </div>
    </div>
</div>

@endsection
