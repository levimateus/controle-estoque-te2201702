<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class ProdutosTest extends TestCase
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

		public function test_usuarios_logados_podem_inserir_produtos(){
				Artisan::call('migrate');
				$usuario = factory('App\User')->create();
				$fornecedor = factory('App\Fornecedor')->create();

				$response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/inserir/produto', [
		            'nome' => 'Garrafa',
		            'descricao' => 'Garrafa de água',
		            'custo' => '20',
		            'quantidade' => '100',
		            'fornecedor' => ''.$fornecedor->id,
		            '_token' => csrf_token()
		        ]);

		        $response->assertStatus(302);
		        $this->assertDatabaseHas('produtos', 
		        	[
		            'nome' => 'Garrafa',
		            'descricao' => 'Garrafa de água',
		            'custo' => '20.0',
		            'quantidade' => '100',
		            'fornecedor_id' => ''.$fornecedor->id,
		        ]);
		}

		public function test_usuarios_nao_logados_nao_inserem_produtos(){
			    Artisan::call('migrate');
        
				$fornecedor = factory('App\Fornecedor')->create();

				$response = $this->withExceptionHandling()->call('POST', '/inserir/produto', [
		            'nome' => 'Garrafa',
		            'descricao' => 'Garrafa de água',
		            'custo' => '20',
		            'quantidade' => '100',
		            'fornecedor' => ''.$fornecedor->id,
		            '_token' => csrf_token()
		        ]);

		        $response->assertStatus(403);
		        $this->assertDatabaseMissing('produtos', 
		        	[
		            'nome' => 'Garrafa',
		            'descricao' => 'Garrafa de água',
		            'custo' => '20.0',
		            'quantidade' => '100',
		            'fornecedor_id' => ''.$fornecedor->id,
		        ]);
		}

		public function test_usuarios_logados_podem_dar_baixa_na_quantidade_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_produtos_com_quantidade_zero_sao_exibidos_separadamente(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_logados_podem_listar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_logados_podem_buscar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_logados_podem_editar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_logados_podem_exibir_produtos_de_um_fornecedor(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}
}
