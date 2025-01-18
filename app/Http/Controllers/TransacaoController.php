<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Transacao;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Jobs\EnviarEmailPontosJob;
use Exception;

class TransacaoController extends Controller
{
    public function pontuar(Request $request, int $cliente_id)
    {
        try {
            $cliente = Cliente::find($cliente_id);
            if (!$cliente) {
                return response()->json([
                    'erro' => 'Não foi possivel encontrar o cliente!',
                ], 404);
            }

            $data = $request->validate([
                'valor_gasto' => 'required|numeric'
            ]);

            $pontos = $this->validarValor($cliente, $data['valor_gasto']);

            $inserirTransacao = Transacao::create([
                'cliente_id' => $cliente_id,
                'valor_gasto' => $data['valor_gasto'],
                'pontos_ganhos' => $pontos
            ]);

            EnviarEmailPontosJob::dispatch($cliente, $pontos);

            return response()->json([
                'mensagem' => 'Pontuação inserida com sucesso.',
                'dados' => $inserirTransacao
            ], 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    private function validarValor($cliente, $valor)
    {
        $pontuacao = 1;
        $valorMinimo = 5;

        if ($valor < $valorMinimo) {
            return 0;
        } else {
            $pontosUnidades = floor($valor / $valorMinimo);
            $pontosTotais = $pontosUnidades * $pontuacao;

            $this->atualizarSaldo($cliente, $pontosTotais);

            return $pontosTotais;
        }
    }

    private function atualizarSaldo($cliente, $pontos)
    {
        $pontosTotais = $cliente->saldo_pontos + $pontos;

        $cliente->update([
            'saldo_pontos' => $pontosTotais
        ]);
    }
}
