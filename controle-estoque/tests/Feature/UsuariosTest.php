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

        $password = bcrypt('password');

        //cadastro do usuário de teste no banco de dados
        User::create([
            'name' => 'jose',
            'email' => 'jose@email.com',
            'admin' => 0,
            'password' => $password
        ]);

        //verificamos se o usuário foi efetivamente cadastrado
        $this->assertDatabaseHas('users', ['email' => 'jose@email.com']);

        //enviamos uma requisição de login
        Session::start();
        $response = $this->withExceptionHandling()->call('POST', '/login', [
            'email' => 'jose@email.com',
            'password' => 'password',
            '_token' => csrf_token()
        ]);

        //verificamos se o sistema redirecionou para a página home
        //se der erro no login, o sistema redireciona para '/'
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/home');
    }

    public function test_usuario_nao_cadastrado_nao_consegue_logar(){
        Artisan::call('migrate');
        Session::start();

        //enviamos uma requisição de login
        $response = $this->withExceptionHandling()->call('POST', '/login', [
            'email' => 'bad@email.com',
            'password' => 'badpassword',
            '_token' => csrf_token()
        ]);

        //verifica se existe esse usuário no banco de dados
        $this->assertDatabaseMissing('users', ['email' => 'bad@email.com']);

        //verificamos o redirecionamento. Login inválido redirecina para /
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/');
    }

    public function test_usuarios_nao_cadastrados_nao_podem_cadastrar_usuarios(){
        Artisan::call('migrate');

        //envia-se uma requisição de cadastro de novo usuário
        $response = $this->withExceptionHandling()->call('POST', '/register', [
            'name' => 'name',
            'email' => 'usuario@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'admin' => 0,
            '_token' => csrf_token()
        ]);

        //verifica a ausência do usuário no banco de dados
        $this->assertDatabaseMissing('users', ['email' => 'usuario@email.com']);      
    }

    public function test_usuarios_comuns_nao_podem_cadastrar_usuarios(){
        Artisan::call('migrate');

        //cadastro do usuário de teste no banco de dados
        $password = bcrypt('password');
        $usuario = User::create([
            'name' => 'jose',
            'email' => 'jose@email.com',
            'admin' => 0,
            'password' => $password
        ]);

        //verificamos se foi cadastrado no banco de dados 
        $this->assertDatabaseHas('users', ['email' => 'jose@email.com']);

        //envia-se uma requisição de cadastro de novo usuário
        $response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/register', [
            'name' => 'name',
            'email' => 'usuario@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'admin' => 0,
            '_token' => csrf_token()
        ]);

        //verifica a ausência do usuário no banco de dados
        $this->assertDatabaseMissing('users', ['email' => 'usuario@email.com']);
    }

    public function test_usuario_administrador_pode_cadastrar_usuarios(){
        Artisan::call('migrate');

        //cadastro do usuário de teste no banco de dados
        $password = bcrypt('password');
        $usuario = User::create([
            'name' => 'jose',
            'email' => 'jose@email.com',
            'admin' => 1,
            'password' => $password
        ]);

        //verificamos se foi cadastrado no banco de dados 
        $this->assertDatabaseHas('users', ['email' => 'jose@email.com']);

        //envia-se uma requisição de cadastro de novo usuário
        $response = $this->withExceptionHandling()->actingAs($usuario)->call('POST', '/register', [
            'name' => 'name',
            'email' => 'usuario@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'admin' => 0,
            '_token' => csrf_token()
        ]);

        //verifica se o usuário foi cadastrado
        $this->assertDatabaseHas('users', ['email' => 'usuario@email.com']);
    }

    public function test_usuario_administrador_pode_desativar_acesso_de_usuarios(){
        
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
