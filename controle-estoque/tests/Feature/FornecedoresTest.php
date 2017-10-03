<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class FornecedoresTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_usuarios_logados_podem_inserir_fornecedores(){
        Artisan::call('migrate');

        //criamos o usuário
        $usuario = factory('App\User')->create();
        //envia a requisição de inserção de fornecedor
        $response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/inserir/fornecedor', [
            'nome' => 'Plásticos Federal Ltda',
            'cnpj' => '97377559000177',
            'endereco' => 'Av. Salgado Filho, 2457',
            '_token' => csrf_token()
        ]);
        //verifica se a página foi redirecionada
        $response->assertStatus(302);
        //verifica se o fornecedor foi inserido no banco de dados
        $this->assertDatabaseHas('fornecedores', ['nome' => 'Plásticos Federal Ltda', 'cnpj' => '97377559000177', 'endereco' => 'Av. Salgado Filho, 2457']);
    }

    public function test_usuarios_nao_logados_nao_inserem_fornecedores(){
        Artisan::call('migrate');
        
        //envia a requisição de inserção de fornecedor agora SEM O ACTING AS $USUARIO
        $response = $this->withExceptionHandling()->call('POST', '/inserir/fornecedor', [
            'nome' => 'Plásticos Federal Ltda',
            'cnpj' => '97377559000177',
            'endereco' => 'Av. Salgado Filho, 2457',
            '_token' => csrf_token()
        ]);

        //verifica se a requisição retorna o status '403 forbidden' 
        $response->assertStatus(403);
        //certifica que o fornecedor não foi inserido
        $this->assertDatabaseMissing('fornecedores', ['nome' => 'Plásticos Federal Ltda', 'cnpj' => '97377559000177', 'endereco' => 'Av. Salgado Filho, 2457']);

    }

    public function test_usuarios_logados_podem_listar_fornecedores(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_logados_podem_buscar_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_logados_podem_editar_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function test_usuarios_logados_podem_excluir_fornecedor(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

 	public function test_fornecedor_se_associa_zero_ou_muitos_produtos(){

        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );

 	}
}
