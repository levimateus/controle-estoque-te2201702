<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

		public function test_usuarios_podem_inserir_produtos(){
				
				$usuario = factory('App\User')->create();


		}

		public function test_usuarios_podem_dar_baixa_em_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_podem_listar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_podem_buscar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_podem_editar_produtos(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}

		public function test_usuarios_podem_exibir_produtos_de_um_fornecedor(){
			
				$this->markTestIncomplete(
					'This test has not been implemented yet.'
				);
		}
}
