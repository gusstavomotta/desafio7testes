<?php

class CalculadoraFinanceira
{
    public array $tipos_amortizacao = ['sac', 'price'];

    public function calcularJurosSimples($capital, $taxa, $tempo)
    {
        return $capital * $taxa / 100  * $tempo;
    }

    public function calcularJurosCompostos($capital, $taxa, $tempo)
    {

        if ($tempo == 0) {
            return $capital;
        }

        $capital = ($capital * ($taxa / 100 + 1));
        $tempo--;
        return $this->calcularJurosCompostos($capital, $taxa, $tempo);
    }

    public function calcularAmortizacao($emprestimo, $taxa, $tempo, $tipo, $valor_pago)
    {

        if ($tempo == 0) {
            return $valor_pago;
        }

        if (!in_array($tipo, $this->tipos_amortizacao)) {
            throw new Exception("Tipo de amortização inválida, insira novamente!");

        } elseif ($tipo == 'sac') {

            $valor_prestacao = $emprestimo / $tempo;
            $valor_juros = $emprestimo * $taxa / 100;

            $valor_pago += $valor_prestacao + $valor_juros;
            $emprestimo -= $valor_prestacao;

            $tempo--;
            return $this->calcularAmortizacao($emprestimo, $taxa, $tempo, $tipo, $valor_pago);

        } else {

            $valor_prestacao = $emprestimo * ($taxa / 100 * pow(1 + $taxa / 100, $tempo)) / (pow(1 + $taxa / 100, $tempo) - 1);
            $valor_juros = $emprestimo * $taxa / 100;

            $valor_pago += $valor_prestacao;
            $emprestimo -= ($valor_prestacao - $valor_juros);

            $tempo--;
            return $this->calcularAmortizacao($emprestimo, $taxa, $tempo, $tipo, $valor_pago);
        }
    }
}
