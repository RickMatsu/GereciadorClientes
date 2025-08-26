<?php
namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Operadora;
use App\Models\StatusCliente; 
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('operadora')->latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $operadoras = Operadora::all(); // Busca todas as operadoras
        $status = StatusCliente::all(); //  Busca todos os Status
        return view('clientes.create', compact('operadoras', 'status')); // Formulário de criação
    }

    public function store(Request $request)
    {  
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'documento' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^\d{11}$|^\d{14}$/', $value)) {
                    $fail('O documento deve ter 11 (CPF) ou 14 (CNPJ) dígitos.');
                }
            }],
            'operadora' => 'required|exists:operadoras,id',
            'status' => 'required|exists:status_cliente,id',
            'data_nascimento' => 'required|date',
            'data_recebimento' => 'required|date',
            'nome_empresa' => 'nullable|string|max:255',
            'numero_vidas' => 'required|numeric',
            'valor' => 'required|numeric',
            'numero_proposta' => 'nullable|string|max:255',
            'observacao' => 'nullable|string|max:255',
        ]);            

        // Define CPF ou CNPJ com base no tamanho
        $cpf = (strlen($validatedData['documento']) == 11) ? $validatedData['documento'] : null;
        $cnpj = (strlen($validatedData['documento']) == 14) ? $validatedData['documento'] : null;

        Cliente::create([
            'nome' => $validatedData['nome'],
            'email' => $validatedData['email'],
            'cpf' => $cpf,
            'cnpj' => $cnpj,
            'operadora_id' => $validatedData['operadora'],
            'status_id' => $validatedData['status'],
            'data_nascimento' => $validatedData['data_nascimento'],
            'data_recebimento' => $validatedData['data_recebimento'],
            'nome_empresa' => $validatedData['nome_empresa'] ?? null,
            'numero_vidas' => $validatedData['numero_vidas'] ?? null,
            'valor' => $validatedData['valor'],
            'numero_proposta' => $validatedData['numero_proposta'] ?? null,
            'observacao' => $validatedData['observacao'] ?? null,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente')); // Exibe um cliente
    }

    public function edit(Cliente $cliente)
    {
        $operadoras = Operadora::all();
        $status = StatusCliente::all();
        return view('clientes.edit', compact('cliente', 'operadoras', 'status')); // Formulário de edição
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'cpf' => 'nullable|digits:11',
            'cnpj' => 'nullable|digits:14',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
    
}
