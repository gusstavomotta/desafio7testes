<?php 

class CalculadoraFinanceira{
    public const tipos_amortizacao = ['sac', 'price'];

    // public function calcularJurosSimples($capital, $taxa, $tempo){
    //     return  $capital * ($taxa/100 + 1) * $tempo;
    // }
    public function calcularJurosCompostos($capital, $taxa, $tempo){

        if ($tempo == 0){
            return number_format($capital, 2, ",", "");
        }
        
        $capital = ($capital * ($taxa/100 + 1));
        $tempo --;
        return $this->calcularJurosCompostos($capital, $taxa, $tempo);
    }
    // public function calcularJurosCompostos2($capital, $taxa, $tempo){
    //   return $capital * pow(($taxa/100 + 1), $tempo);
    // }
    public function calcularAmortizacao($capital, $taxa, $tempo,$tipo,$saldoDevedor){

    }
}