<?php

namespace Tests\Unit;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Enums\PersonType;
use Tests\TestCase as TestCase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_supplier_legal(): void
    {
        $data = [
            'name' => 'Company SA',
            'trade_name' => 'Company',
            'person_type' => PersonType::LEGAL
        ];

        $supplier = Supplier::create($data);

        $this->assertDatabaseHas('suppliers', $data);
        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertEquals('Company SA', $supplier->name);
        $this->assertEquals('Company', $supplier->trade_name);
        $this->assertEquals(PersonType::LEGAL, $supplier->person_type);
    }

    public function test_create_supplier_natural(): void
    {
        $data = [
            'name' => 'Company SA',
            'person_type' => PersonType::NATURAL
        ];

        $supplier = Supplier::create($data);

        $this->assertDatabaseHas('suppliers', $data);
        $this->assertInstanceOf(Supplier::class, $supplier);
        $this->assertEquals('Company SA', $supplier->name);
        $this->assertNull($supplier->trade_name);
        $this->assertEquals(PersonType::NATURAL, $supplier->person_type);
    }
}
