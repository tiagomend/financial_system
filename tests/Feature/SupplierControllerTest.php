<?php

namespace Tests\Feature;

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
        ];

        // Faz a requisição POST para o método store
        $response = $this->post(route('suppliers.store'), $data);

        // Verifica se a resposta está OK (status 200 ou 201 dependendo do caso)
        $response->assertStatus(201);

        // Verifica se os dados foram salvos no banco
        $this->assertDatabaseHas('suppliers', $data);

        // Verifica a estrutura da resposta JSON
        $response->assertJsonStructure([
            'id',
            'name',
            'trade_name',
            'person_type',
            'created_at',
            'updated_at',
        ]);
    }
}
