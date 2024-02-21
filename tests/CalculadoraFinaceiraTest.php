<?php 
use PHPUnit\Framework\TestCase;
require_once "src/CalculadoraFinanceira.php";

class CalculadoraFinaceiraTest extends TestCase {

    public $calculadoraFinanceira;
    public function setUp():void{

        $this->calculadoraFinanceira = new CalculadoraFinanceira;
    }

    public function testCalcularJurosSimples(){
        $capital = 1000;
        $taxa = 0.5;
        $tempo = 2;
        $this->calculadoraFinanceira->calcularJurosSimples($capital, $taxa, $tempo);
    }
    public function testCalcularJurosCompostos(){
        $capital = 1000;
        $taxa = 0.5;
        $tempo = 2;
        $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);

    }
    public function testCalcularAmortizacao(){
        $capital = 1000;
        $taxa = 0.5;
        $tempo = 2;
        $tipo = 'sac';
        $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo,$tipo);

    }
}