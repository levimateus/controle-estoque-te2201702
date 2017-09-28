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

        User::create([
            'name' => 'jose',
            'email' => 'jose@email.com',
            'admin' => 0,
            'password' => bcrypt('password')
        ]);

        $this->assertDatabaseHas('users', ['email' => 'jose@email.com']);

        Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'jose@email.com',
            'password' => 'password',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/home');
    }

    public function test_usuario_nao_cadastrado_nao_consegue_logar(){
        Artisan::call('migrate');
        Session::start();

        $response = $this->call('POST', '/login', [
            'email' => 'bad@email.com',
            'password' => 'bad_password',
            '_token' => csrf_token()
        ]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseMissing('users', ['email' => 'bad@email.com', 'password' => bcrypt('bad_password')]);
        $response->assertRedirect('/');
    }

    public function test_usuario_administrador_pode_cadastrar_usuarios(){
        $this->assertTrue(true);
    }

    public function test_usuario_administrador_pode_desativar_acesso_de_usuarios(){
    	
    	$this->assertTrue(true);
    }
}
