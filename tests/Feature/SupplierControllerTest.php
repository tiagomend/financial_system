<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se o método store cria um fornecedor corretamente.
     */
    public function test_store_creates_a_supplier()
    {
        // Dados simulados para o fornecedor
        $data = [
            'name' => 'Fornecedor Teste',
            'trade_name' => 'Fantasia Teste',
            'person_type' => 'legal',
            'cnpj' => '88823401000192',
            'street_type' => 'road',
            'street' => 'Antonio Boscaglia',
            'number' => '96',
            'complement' => 'Adm',
            'neighborhood' => 'Nova Igarapava',
            'city' => 'Igarapava',
            'state' => 'SP',
            'postal_code' => '14540-000',
            'country' => 'Brasil'
        ];

        // Faz a requisição POST para o método store
        $response = $this->post(route('suppliers.store'), $data);

        // Verifica se a resposta está OK (status 200 ou 201 dependendo do caso)
        $response->assertStatus(201);

        // Verifica se os dados foram salvos no banco
        $this->assertDatabaseHas(
            'suppliers',
            [
                'name' => 'Fornecedor Teste',
                'trade_name' => 'Fantasia Teste',
                'person_type' => 'legal',
            ]
        );

        // Verifica a estrutura da resposta JSON
        $response->assertJsonStructure([
            'id',
            'name',
            'trade_name',
            'person_type',
            'created_at',
            'updated_at',
        ]);

        $this->assertDatabaseHas('documents', [
            'type' => 'cnpj',
            'value' => '88823401000192',
        ]);
    }
}
