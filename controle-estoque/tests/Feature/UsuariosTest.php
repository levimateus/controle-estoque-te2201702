<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\User;

class UsuariosTest extends TestCase
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
        Artisan::call('migrate');

        $usuario = new User;
        $usuario->name = 'josé';
        $usuario->email = 'josé@email.com';
        $usuario->password = bcrypt('password');

        Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'jose@email.com',
            'password' => 'password',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function test_usuario_administrador_pode_cadastrar_usuarios(){

    	$this->assertTrue(true);
    }

    public function test_usuario_administrador_pode_desativar_acesso_de_usuarios(){
    	
    	$this->assertTrue(true);
    }
}
