<?php

use PHPUnit\Framework\TestCase;
require_once "src/CalculadoraFinanceira.php";

class CalculadoraFinaceiraTest extends TestCase{
    public $calculadoraFinanceira;
    public function setUp(): void{

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

        $juros = $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);
        $this->assertEquals(331, $juros);
    }

    public function testCalcularAmortizacaoSac(){

        $capital = 20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'sac';
        $valor_juros = 0;
        $parcelas = array();

        $dados = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros, $parcelas);
        $this->assertEquals(3600.00, $dados['juros']);
        $this->assertEquals(2500, $dados['parcelas'][0]);
    }

    public function testCalcularAmortizacaoPrice(){

        $capital = 20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'price';
        $valor_juros = 0;
        $parcelas = array();

        $dados = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros,$parcelas);
        $this->assertEquals(3764.45, $dados['juros']);
        $this->assertEquals(2500, number_format( array_sum($dados['parcelas'])/count($dados['parcelas']), 2, ".", ""));
    }

    public function testCalcularJurosSimplesValoresNegativos(){

        $capital = -1000;
        $taxa = -10;
        $tempo = 3;

        $this->expectExceptionMessage("Os dados inseridos são inválidos, insira novamente!");
        $this->calculadoraFinanceira->calcularJurosSimples($capital, $taxa, $tempo);
    }

    public function testCalcularJurosCompostosValoresNegativosInvalidos(){

        $capital = -1000;
        $taxa = 10;
        $tempo = -3;

        $this->expectExceptionMessage("Os dados inseridos são inválidos, insira novamente!");
        $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);
    }

    public function testCalcularAmortizacaoSacComValoresNegativos(){

        $capital = -20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'sac';
        $valor_juros = 0;
        $parcelas = array();

        $this->expectExceptionMessage("Os dados inseridos são inválidos, insira novamente!");
        $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros,$parcelas);
    }

    public function testCalcularAmortizacaoPriceComValoresNegativos(){

        $capital = -20000;
        $taxa = -4;
        $tempo = -8;
        $tipo = 'price';
        $valor_juros = 0;
        $parcelas = array();

        $this->expectExceptionMessage("Os dados inseridos são inválidos, insira novamente!");
        $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros, $parcelas);
    }

    public function testCalcularAmortizacaoComTipoInvalido(){

        $capital = 20000;
        $taxa = 4;
        $tempo = 8;
        $tipo = 'assa';
        $valor_juros = 0;
        $parcelas = array();

        $this->expectExceptionMessage("Tipo de amortização inválida, insira novamente!");
        $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros,$parcelas);
    }

    public function testCalcularJurosSimplesValoresExtremos(){

        $capital = 10;
        $taxa = 90;
        $tempo = 200;

        $juros = $this->calculadoraFinanceira->calcularJurosSimples($capital, $taxa, $tempo);
        $this->assertEquals(1800, $juros);
    }

    public function testCalcularJurosCompostosValoresExtremos(){

        $capital = 10;
        $taxa = 95;
        $tempo = 1;

        $juros = $this->calculadoraFinanceira->calcularJurosCompostos($capital, $taxa, $tempo);
        $this->assertEquals(9.50, $juros);
    }

    public function testCalcularAmortizacaoSacValoresExtremos(){

        $capital = 50;
        $taxa = 85;
        $tempo = 1;
        $tipo = 'sac';
        $valor_juros = 0;
        $parcelas = array();

        $dados = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros,$parcelas);

        $this->assertEquals(42.50, $dados['juros']);
        $this->assertEquals(50, number_format( array_sum($dados['parcelas'])/count($dados['parcelas']), 2, ".", ""));

    }

    public function testCalcularAmortizacaoPriceValoresExtremos(){

        $capital = 200;
        $taxa = 97;
        $tempo = 1;
        $tipo = 'price';
        $valor_juros = 0;
        $parcelas = array();

        $dados = $this->calculadoraFinanceira->calcularAmortizacao($capital, $taxa, $tempo, $tipo, $valor_juros,$parcelas);
        $this->assertEquals(194.00, $dados['juros']);
        $this->assertEquals(200, number_format( array_sum($dados['parcelas'])/count($dados['parcelas']), 2, ".", ""));

    }
}
    