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

		public function test_usuarios_logados_podem_acessar_pagina_de_produtos(){
			Artisan::call('migrate');
			$usuario = factory('App\User')->create();

			//se não estiver logado
       		$response = $this->withExceptionHandling()->call('GET', '/produtos');
       		$response->assertStatus(403);

       		//se estiver
       		$response = $this->withExceptionHandling()->actingAs($usuario)->call('GET', '/produtos');
       		$response->assertStatus(200);
       		
		}

		public function test_usuarios_logados_podem_dar_baixa_na_quantidade_produtos(){
			Artisan::call('migrate');
			$usuario = factory('App\User')->create();
			$fornecedor = factory('App\Fornecedor')->create();
			$produto = factory('App\Produto')->create();

			$quantidadeInicial = $produto->quantidade;

			//se não estiver logado, deve dar erro
			$response = $this->withExceptionHandling()->call('POST', '/debitar/produto', ['id' => ''.$produto->id, 'quantidade' => '3']);
			$response->assertStatus(403);

			//se estiver, vai dar tudo ok
			$response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/debitar/produto', ['id' => ''.$produto->id, 'quantidade' => '3']);

			$produto = \App\Produto::all()->first();
			$response->assertStatus(302);
			$this->assertTrue(($quantidadeInicial - $produto->quantidade) == 3);

		}

		public function test_produtos_com_quantidade_zero_sao_exibidos_separadamente(){
			
			Artisan::call('migrate');

			$usuario = factory('App\User')->create();

			$fornecedor = factory('App\Fornecedor')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();

			$produtos[3]->quantidade = 0;
			$produtos[3]->save();

			$produtos[4]->quantidade = 0;
			$produtos[4]->save();


			$this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

			$response = $this//->withExceptionHandling()
						     ->actingAs($usuario)
						     ->call('GET', '/produtos/esgotados');

			$response->assertStatus(200);

            $response->assertSee(''.$produtos[3]->quantidade);
		}

		public function test_usuarios_logados_podem_listar_produtos(){
			Artisan::call('migrate');

			$usuario = factory('App\User')->create();

			$fornecedor = factory('App\Fornecedor')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();


			$this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

			$response = $this->withExceptionHandling()
						     ->actingAs($usuario)
						     ->call('GET', '/produtos');

			$response->assertStatus(200);

			foreach ($produtos as $produto) {
	            $response->assertSee($produto->nome);
	            $response->assertSee(''.$produto->custo);
	            $response->assertSee(''.$produto->quantidade);
        	}
		}

		public function test_usuarios_logados_podem_buscar_produtos(){
			Artisan::call('migrate');

			$usuario = factory('App\User')->create();

			$fornecedor = factory('App\Fornecedor')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();


			$this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

			$response = $this->withExceptionHandling()
						     ->actingAs($usuario)
						     ->call('GET', '/produtos/buscar', ['nome' => $produtos[3]->nome]);

			$response->assertStatus(200);

            $response->assertSee($produtos[3]->nome);
            $response->assertSee(''.$produtos[3]->custo);
            $response->assertSee(''.$produtos[3]->quantidade);
		}

		public function test_usuarios_logados_podem_editar_produtos(){
			Artisan::call('migrate');
			$usuario = factory('App\User')->create();
			$fornecedor = factory('App\Fornecedor')->create();
			$produto = factory('App\Produto')->create();
			$produtoEditado = array(
	            'id' => $produto->id,
	            'nome' => 'Garrafa',
	            'descricao' => $produto->descricao,
	            'custo' => $produto->custo,
	            'quantidade' => $produto->quantidade,
	            'fornecedor' => $produto->fornecedor_id,
	            '_token' => csrf_token()
	        );

	        $this->assertDatabaseHas('produtos', ['id' => ''.$produto->id]);
	        $this->assertDatabaseMissing('produtos', ['nome' => 'Garrafa']);
	        //se não estiver logado
	        $response = $this->withExceptionHandling()->call('POST', '/editar/produto', $produtoEditado);
	        $response->assertStatus(403);

	        //se estiver
			$response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/editar/produto', $produtoEditado);

	        $response->assertStatus(302);
	        $this->assertDatabaseHas('produtos', ['nome' => 'Garrafa']);
	        $this->assertDatabaseHas('produtos', ['id' => ''.$produto->id]);
		}

		public function test_usuarios_logados_podem_exibir_produtos_de_um_fornecedor(){
			Artisan::call('migrate');

			$usuario = factory('App\User')->create();

			$fornecedor = factory('App\Fornecedor')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();
			$produtos[] = factory('App\Produto')->create();


			$this->assertDatabaseHas('fornecedores', ['id' => $fornecedor->id]);

			$response = $this->withExceptionHandling()
						     ->actingAs($usuario)
						     ->call('GET', '/produtos/fornecedor/'.$fornecedor->id);

			$response->assertStatus(200);

			foreach ($produtos as $produto) {
	            $response->assertSee($produto->nome);
	            $response->assertSee(''.$produto->custo);
	            $response->assertSee(''.$produto->quantidade);
        	}

		}
}
