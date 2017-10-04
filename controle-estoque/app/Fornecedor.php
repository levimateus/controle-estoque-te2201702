<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    protected $table = 'fornecedores';

   	protected $fillable = ['nome', 'cnpj', 'endereco'];

    public function produtos(){
    	return $this->hasMany(Produto::class);
    }
}
