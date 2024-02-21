<?php 
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

require_once "src/CalculadoraFinanceira.php";

class CalculadoraFinaceiraTest extends TestCase {

    public $calculadoraFinanceira;
    public function setUp():void{

        $this->calculadoraFinanceira = new CalculadoraFinanceira;
    }

    // public function testCalcularJurosSimples(){
    //     $capital = 1000;
    //     $taxa = 0.5;
    //     $tempo = 2;

    //     $juros = $this->calculadoraFinanceira->calcularJurosSimples($capital, $taxa, $tempo);
    //     $this->assertEquals(1100, $juros);
    //     }
    public function testCalcularJurosCompostos(){
        $capital = 1000;
        $taxa = 10;
        $tempo = 3;

        $montante = $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);
        $this->assertEquals('1331,00', $montante);
    }
    // public function testCalcularAmortizacao(){
    //     $capital = 1000;
    //     $taxa = 0.5;
    //     $tempo = 2;
    //     $tipo = 'sac';
    //     $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo,$tipo);

    // }
}