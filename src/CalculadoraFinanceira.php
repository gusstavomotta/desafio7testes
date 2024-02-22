<?php

class CalculadoraFinanceira
{
    public array $tipos_amortizacao = ['sac', 'price'];

    public function calcularJurosSimples(float $capital, float $taxa, int $tempo)
    {   
        if($this->validar_dados([$capital, $taxa, $tempo]) == false){
            throw new Exception ("Os dados inseridos são inválidos, insira novamente! ");
        }

        return $capital * $taxa / 100  * $tempo;
    }

    public function calcularJurosCompostos(float $capital, float $taxa, int $tempo)
    {
        if($this->validar_dados([$capital, $taxa, $tempo]) == false){
            throw new Exception ("Os dados inseridos são inválidos, insira novamente! ");
        }

        $montante = $capital * (pow($taxa/100 + 1, $tempo));
        return number_format($montante - $capital, 2 , ".", "");
    }

    public function calcularAmortizacao(float $emprestimo, float $taxa, int $tempo, String $tipo, float $montante_pago)
    {
        if($this->validar_dados([$emprestimo, $taxa, $tempo, $montante_pago]) == false){
            throw new Exception ("Os dados inseridos são inválidos, insira novamente!");
        }

        if ($tempo == 0) {
            return number_format($montante_pago, 2, ".", "");
        }

        if (!in_array($tipo, $this->tipos_amortizacao)) {
            throw new Exception("Tipo de amortização inválida, insira novamente!");

        } elseif ($tipo == 'sac') {

            $valor_amortizacao = $emprestimo / $tempo;
            $valor_juros = $emprestimo * $taxa / 100;

            $montante_pago += $valor_amortizacao + $valor_juros;
            $emprestimo -= $valor_amortizacao;

            $tempo--;
            return $this->calcularAmortizacao($emprestimo, $taxa, $tempo, $tipo, $montante_pago);

        } else {

            $valor_prestacao = $emprestimo * ($taxa / 100 * pow(1 + $taxa / 100, $tempo)) / (pow(1 + $taxa / 100, $tempo) - 1);
            $valor_juros = $emprestimo * $taxa / 100;

            $montante_pago += $valor_prestacao;
            $emprestimo -= ($valor_prestacao - $valor_juros);

            $tempo--;
            return $this->calcularAmortizacao($emprestimo, $taxa, $tempo, $tipo, $montante_pago);
        }
    }
    public function validar_dados(array $array_dados){

        if (count($array_dados) != 3 && count($array_dados) != 4){
            return false;
        }
        
        foreach ($array_dados as $dados){
            if (!is_numeric($dados) || $dados < 0){
                return false;
            }
        }
        return true;
    }
}
