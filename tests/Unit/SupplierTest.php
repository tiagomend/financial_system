<?php

namespace Tests\Unit;

use App\Enums\PersonType;
use App\Models\Address;
use App\Models\Document;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase as TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    private array $data;

    private Supplier $supplier;

    private Address $address;

    protected function setUp(): void
    {
        parent::setUp();

        $this->address = Address::create([
            'street_type' => 'road',
            'street' => 'Antonio Boscaglia',
            'number' => '96',
            'complement' => 'Adm',
            'neighborhood' => 'Nova Igarapava',
            'city' => 'Igarapava',
            'state' => 'SP',
            'postal_code' => '14540-000',
            'country' => 'Brasil',
        ]);

        $this->data = [
            'name' => 'Company SA',
            'trade_name' => 'Company',
            'person_type' => PersonType::LEGAL,
            'address_id' => $this->address->id,
        ];

        $this->supplier = Supplier::create($this->data);
    }

    public function test_create_supplier_legal(): void
    {
        $this->assertDatabaseHas('suppliers', $this->data);
        $this->assertInstanceOf(Supplier::class, $this->supplier);
        $this->assertEquals('Company SA', $this->supplier->name);
        $this->assertEquals('Company', $this->supplier->trade_name);
        $this->assertEquals(PersonType::LEGAL, $this->supplier->person_type);
    }

    public function test_create_supplier_natural(): void
    {
        $data = [
            'name' => 'Company SA',
            'person_type' => PersonType::NATURAL,
            'address_id' => $this->address->id,
        ];

        $supplier = Supplier::create($data);

        $this->assertDatabaseHas('suppliers', $data);
        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertEquals('Company SA', $supplier->name);
        $this->assertNull($supplier->trade_name);
        $this->assertEquals(PersonType::NATURAL, $supplier->person_type);
    }

    public function test_relationship_with_document(): void
    {
        $document = Document::create([
            'type' => 'cnpj',
            'value' => '88823401000192',
        ]);
        SupplierDocument::create([
            'supplier_id' => $this->supplier->id,
            'document_id' => $document->id,
        ]);

        $this->assertCount(1, $this->supplier->documents);
        $this->assertTrue($this->supplier->documents->contains($document));
    }
}
