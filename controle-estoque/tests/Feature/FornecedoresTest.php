<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FornecedoresTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_podem_inserir_fornecedores(){
      	$usuario = factory('App\User')->create();

        $response = $this->withExceptionHandling()->call('POST', '/inserir/fornecedor', [
            'nome' => 'Plásticos Federal Ltda',
            'cnpj' => '97377559000177',
            'endereco' => 'Av. Salgado Filho, 2457',
            '_token' => csrf_token()
        ]);

        $response->assertStatus(302);
        $response->assertDatabaseHas('fornecedores', ['nome' => 'Plásticos Federal Ltda', 'cnpj' => '97377559000177', 'endereco' => 'Av. Salgado Filho, 2457']);
    }

    public function test_usuarios_podem_listar_fornecedores(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_podem_buscar_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_podem_editar_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_podem_excluir_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

 	public function test_fornecedor_se_associa_zero_ou_muitos_prod(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

 	}
}
