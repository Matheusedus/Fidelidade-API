<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Cliente;


class ClienteController extends Controller
{
    public function cadastrarCliente(Request $request)
    {
        $data = $request->validate([
            "nome" => "required|string|max:255",
            "email" => "required|email|unique:clientes,email"
        ]);

        $cliente = Cliente::create($data);
        return response()->json(["mensagem" => "Cliente cadastrado com sucesso!", "dados" => $cliente], 201);
    }

    public function mostrarCliente(int|string $search)
    {
        if (!is_numeric($search)) {
            $cliente = Cliente::where('email', $search)->first();
        } else {
            $cliente = Cliente::find($search);
        }

        if (!$cliente) {
            return response()->json(['erro' => 'Cliente não encontrado'], 404);
        }

        return response()->json(["mensagem" => "Cliente recuperado com sucesso!", "dados" => $cliente]);
    }

    public function exibirSaldo(int|string $search)
    {
        if (!is_numeric($search)) {
            $cliente = Cliente::with(['transacoes', 'recompensas'])->where('email', $search)->first();
        } else {
            $cliente = Cliente::with(['transacoes', 'recompensas'])->find($search);
        }

        if (!$cliente) {
            return response()->json(['erro' => 'Cliente não encontrado'], 404);
        }

        return response()->json(["mensagem" => "Cliente recuperado com sucesso!", "dados" => $cliente]);
    }

    public function exibirClientes()
    {
        return response()->json(["mensagem" => "Clientes recuperados!", "dados" => Cliente::all()]);
    }
}
