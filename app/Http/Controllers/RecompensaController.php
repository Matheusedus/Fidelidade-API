<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarEmailResgateJob;
use App\Models\Brindes;
use App\Models\Cliente;
use App\Models\Recompensa;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;


class RecompensaController extends Controller
{
    public function resgatar(Request $request, $cliente_id)
    {
        try {

            $data = $request->validate([
                'brinde_id' => 'required|integer|exists:brindes,id',

            ]);

            $cliente = Cliente::find($cliente_id);
            $brinde = Brindes::find($data['brinde_id']);

            if (!$cliente) {
                return response()->json([
                    'message' => 'Não foi possivel encontrar o cliente.',
                ], 404);
            }

            $pontos = $this->validarPontos($cliente, $data['brinde_id']);

            if ($pontos === false) {
                return response()->json([
                    'message' => 'Saldo insuficiente para resgatar o brinde.',
                ], 400);
            }

            $inserirPontuacao = Recompensa::create([
                'cliente_id' => $cliente_id,
                'fk_brinde' => $data['brinde_id'],
                'pontos_usados' => $pontos
            ]);

            EnviarEmailResgateJob::dispatch($cliente, $brinde);

            return response()->json([
                'message' => "Brinde resgatado com sucesso!",
                'data' => $inserirPontuacao
            ], 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    private function validarPontos($cliente, $brinde_id)
    {
        $brinde = Brindes::find($brinde_id);
        $pontosDisponiveis = $cliente->saldo_pontos;

        $valorBrinde = $brinde->valor;

        if ($pontosDisponiveis < $valorBrinde) {
            return false;
        }

        $this->atualizarSaldo($cliente, $valorBrinde);
        return $valorBrinde;
    }

    private function atualizarSaldo($cliente, $pontos)
    {
        $pontosTotais = $cliente->saldo_pontos - $pontos;

        $cliente->update([
            'saldo_pontos' => $pontosTotais
        ]);
    }
}
