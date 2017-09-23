<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Usuariostest extends TestCase
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

    public function test_um_usuario_podera_fazer_login_no_sistema(){

    	$usuario = new User;
    	$usuario->name = "José da Silva";
    	$usuario->email = "jose@email.com";
    	$usuario->password = "password";
    	$usuario->admin = 0;

    	$usuario->save();

    	$login_email = "jose@email.com";
    	$login_password = "password";
    }

    public function test_usuario_administrador_pode_cadastrar_usuarios(){

    	$this->assertTrue(false);
    }

    public function test_usuario_administrador_pode_desativar_acesso_de_usuarios(){
    	
    	$this->assertTrue(false);
    }
}
