<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operadora;

class OperadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera todas as operadoras
        $operadoras = Operadora::paginate(10);

        // Retorna a view com a lista de operadoras
        return view('operadoras.index', compact('operadoras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operadoras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Operadora::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('operadora.index')->with('success', 'Operadora criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        // Busca a operadora pelo ID
        $operadora = Operadora::findOrFail($id);

        // Exibe os detalhes da operadora
        return view('operadoras.show', compact('operadora'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Busca a operadora pelo ID
        $operadora = Operadora::findOrFail($id);

        // Exibe o formulário de edição
        return view('operadoras.edit', compact('operadora'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);
    
        // Encontra a operadora
        $operadora = Operadora::findOrFail($id);
    
        // Atualiza os dados da operadora
        $operadora->update([
            'nome' => $request->nome, // Atualiza o nome da operadora
        ]);
    
        // Redireciona com uma mensagem de sucesso
        return redirect()->route('operadora.index')->with('success', 'Operadora atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encontra a operadora
        $operadora = Operadora::findOrFail($id);

        // Exclui a operadora
        $operadora->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('operadora.index')->with('success', 'Operadora excluída com sucesso!');

    }
}
