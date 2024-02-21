<?php 
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

require_once "src/CalculadoraFinanceira.php";

class CalculadoraFinaceiraTest extends TestCase {

    public $calculadoraFinanceira;
    public function setUp():void{

        $this->calculadoraFinanceira = new CalculadoraFinanceira;
    }

    public function testCalcularJurosSimples(){
        $capital = 1000;
        $taxa = 10;
        $tempo = 3;

        $juros = $this->calculadoraFinanceira->calcularJurosSimples($capital, $taxa, $tempo);
        $this->assertEquals(300, $juros);
    }

    public function testCalcularJurosCompostos(){
        $capital = 1000;
        $taxa = 10;
        $tempo = 3;

        $montante = $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);
        $juros = ($montante - $capital);
        $this->assertEquals(331, $juros);
    }

    public function testCalcularAmortizacaoSac(){
        $capital = 20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'sac';
        $valor_pago = 0;

        $valor_juros = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo,$tipo, $valor_pago);
        $juros = ($valor_juros - $capital);
        $this->assertEquals(3600.00,number_format($juros, 2, ".", ""));
    }
    public function testCalcularAmortizacaoPrice(){
        $capital = 20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'price';
        $valor_pago = 0;

        $valor_juros = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo,$tipo, $valor_pago);
        $juros = $valor_juros - $capital;
        $this->assertEquals(3764.45, number_format($juros, 2, ".", ""));
}
}