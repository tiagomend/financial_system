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

        // Verifica se redireciona para o index
        $response->assertRedirect(route('suppliers.index'));
        $response->assertSessionHas('success', 'Fornecedor criado com sucesso!');

        // Verifica se os dados foram salvos no banco
        $this->assertDatabaseHas(
            'suppliers',
            [
                'name' => 'Fornecedor Teste',
                'trade_name' => 'Fantasia Teste',
                'person_type' => 'legal',
            ]
        );

        $this->assertDatabaseHas('documents', [
            'type' => 'cnpj',
            'value' => '88823401000192',
        ]);
    }

    /**
     * Testa se o método index retorna a lista de fornecedores.
     */
    public function test_index_displays_suppliers()
    {
        // Cria alguns fornecedores de teste
        $address1 = Address::create([
            'street_type' => 'road',
            'street' => 'Test Street',
            'number' => '100',
            'neighborhood' => 'Test Neighborhood',
            'city' => 'Test City',
            'state' => 'TS',
            'postal_code' => '12345-678',
            'country' => 'Brasil'
        ]);

        $supplier1 = Supplier::create([
            'name' => 'Supplier One',
            'trade_name' => 'S1',
            'person_type' => 'legal',
            'address_id' => $address1->id
        ]);

        $address2 = Address::create([
            'street_type' => 'avenue',
            'street' => 'Another Street',
            'number' => '200',
            'neighborhood' => 'Another Neighborhood',
            'city' => 'Another City',
            'state' => 'AS',
            'postal_code' => '98765-432',
            'country' => 'Brasil'
        ]);

        $supplier2 = Supplier::create([
            'name' => 'Supplier Two',
            'trade_name' => 'S2',
            'person_type' => 'natural',
            'address_id' => $address2->id
        ]);

        // Faz a requisição GET para o método index
        $response = $this->get(route('suppliers.index'));

        // Verifica se a resposta está OK
        $response->assertStatus(200);

        // Verifica se os fornecedores aparecem na resposta
        $response->assertSee('Supplier One');
        $response->assertSee('Supplier Two');
    }

    /**
     * Testa se o método show exibe os detalhes de um fornecedor.
     */
    public function test_show_displays_supplier_details()
    {
        $address = Address::create([
            'street_type' => 'road',
            'street' => 'Test Street',
            'number' => '100',
            'neighborhood' => 'Test Neighborhood',
            'city' => 'Test City',
            'state' => 'TS',
            'postal_code' => '12345-678',
            'country' => 'Brasil'
        ]);

        $supplier = Supplier::create([
            'name' => 'Test Supplier',
            'trade_name' => 'TS',
            'person_type' => 'legal',
            'address_id' => $address->id
        ]);

        // Faz a requisição GET para o método show
        $response = $this->get(route('suppliers.show', $supplier->id));

        // Verifica se a resposta está OK
        $response->assertStatus(200);

        // Verifica se os dados do fornecedor aparecem
        $response->assertSee('Test Supplier');
        $response->assertSee('TS');
    }

    /**
     * Testa se o método update atualiza um fornecedor.
     */
    public function test_update_modifies_supplier()
    {
        $address = Address::create([
            'street_type' => 'road',
            'street' => 'Old Street',
            'number' => '100',
            'neighborhood' => 'Old Neighborhood',
            'city' => 'Old City',
            'state' => 'OS',
            'postal_code' => '12345-678',
            'country' => 'Brasil'
        ]);

        $supplier = Supplier::create([
            'name' => 'Old Name',
            'trade_name' => 'Old Trade Name',
            'person_type' => 'legal',
            'address_id' => $address->id
        ]);

        $updateData = [
            'name' => 'New Name',
            'trade_name' => 'New Trade Name',
            'person_type' => 'legal',
            'cnpj' => '12345678000100',
            'street_type' => 'avenue',
            'street' => 'New Street',
            'number' => '200',
            'neighborhood' => 'New Neighborhood',
            'city' => 'New City',
            'state' => 'NS',
            'postal_code' => '98765-432',
            'country' => 'Brasil'
        ];

        // Faz a requisição PUT para o método update
        $response = $this->put(route('suppliers.update', $supplier->id), $updateData);

        // Verifica se redireciona para o index
        $response->assertRedirect(route('suppliers.index'));
        $response->assertSessionHas('success', 'Fornecedor atualizado com sucesso!');

        // Verifica se os dados foram atualizados no banco
        $this->assertDatabaseHas('suppliers', [
            'id' => $supplier->id,
            'name' => 'New Name',
            'trade_name' => 'New Trade Name',
        ]);

        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'street' => 'New Street',
            'city' => 'New City',
        ]);
    }

    /**
     * Testa se o método destroy exclui um fornecedor.
     */
    public function test_destroy_deletes_supplier()
    {
        $address = Address::create([
            'street_type' => 'road',
            'street' => 'Test Street',
            'number' => '100',
            'neighborhood' => 'Test Neighborhood',
            'city' => 'Test City',
            'state' => 'TS',
            'postal_code' => '12345-678',
            'country' => 'Brasil'
        ]);

        $supplier = Supplier::create([
            'name' => 'Supplier to Delete',
            'trade_name' => 'STD',
            'person_type' => 'legal',
            'address_id' => $address->id
        ]);

        // Faz a requisição DELETE para o método destroy
        $response = $this->delete(route('suppliers.destroy', $supplier->id));

        // Verifica se redireciona para o index
        $response->assertRedirect(route('suppliers.index'));
        $response->assertSessionHas('success', 'Fornecedor excluído com sucesso!');

        // Verifica se o fornecedor foi excluído do banco
        $this->assertDatabaseMissing('suppliers', [
            'id' => $supplier->id,
        ]);
    }
}
