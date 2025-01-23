<?php

namespace App\Http\Controllers;

use App\Enums\PersonType;
use App\Models\Address;
use App\Models\Document;
use App\Models\Supplier;
use App\Models\SupplierDocument;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $address = Address::create($request->all());
        $supplier = Supplier::create([...$request->all(), 'address_id' => $address->id]);

        if ($supplier->person_type === PersonType::NATURAL) {
            if ($request->input('cpf')) {
                $cpf = Document::create([
                    'type' => 'cpf',
                    'value' => $request->input('cpf'),
                ]);

                SupplierDocument::create([
                    'supplier_id' => $supplier->id,
                    'document_id' => $cpf->id,
                ]);

                return $supplier;
            } else {
                $supplier->delete();
                return 'Sem documento!';
            }
        }
        if ($supplier->person_type === PersonType::LEGAL) {
            if ($request->input('cnpj')) {
                $cnpj = Document::create([
                    'type' => 'cnpj',
                    'value' => $request->input('cnpj'),
                ]);

                SupplierDocument::create([
                    'supplier_id' => $supplier->id,
                    'document_id' => $cnpj->id,
                ]);

                return $supplier;
            } else {
                $supplier->delete();
                return 'Sem documento!';
            }
        } else {
            $supplier->delete();
            return 'Sem documento!';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
