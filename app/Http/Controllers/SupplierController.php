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
        $suppliers = Supplier::with('documents')->get();

        return view('suppliers.index', compact('suppliers'));
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

                return redirect()->route('suppliers.index')->with('success', 'Fornecedor criado com sucesso!');
            } else {
                $supplier->delete();

                return redirect()->back()->with('error', 'Sem documento!');
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

                return redirect()->route('suppliers.index')->with('success', 'Fornecedor criado com sucesso!');
            } else {
                $supplier->delete();

                return redirect()->back()->with('error', 'Sem documento!');
            }
        } else {
            $supplier->delete();

            return redirect()->back()->with('error', 'Sem documento!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $supplier->load('documents', 'address');

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $supplier->load('documents', 'address');

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Update supplier basic info
        $supplier->update($request->only(['name', 'trade_name', 'person_type']));

        // Update address if exists, create if not
        if ($supplier->address) {
            $supplier->address->update($request->only([
                'street_type', 'street', 'number', 'neighborhood',
                'postal_code', 'city', 'state', 'country',
            ]));
        } else {
            $address = Address::create($request->only([
                'street_type', 'street', 'number', 'neighborhood',
                'postal_code', 'city', 'state', 'country',
            ]));
            $supplier->update(['address_id' => $address->id]);
        }

        // Update document
        $existingDocument = $supplier->documents->first();

        if ($supplier->person_type === PersonType::NATURAL) {
            if ($request->input('cpf')) {
                if ($existingDocument) {
                    $existingDocument->update([
                        'type' => 'cpf',
                        'value' => $request->input('cpf'),
                    ]);
                } else {
                    $cpf = Document::create([
                        'type' => 'cpf',
                        'value' => $request->input('cpf'),
                    ]);
                    SupplierDocument::create([
                        'supplier_id' => $supplier->id,
                        'document_id' => $cpf->id,
                    ]);
                }
            }
        } elseif ($supplier->person_type === PersonType::LEGAL) {
            if ($request->input('cnpj')) {
                if ($existingDocument) {
                    $existingDocument->update([
                        'type' => 'cnpj',
                        'value' => $request->input('cnpj'),
                    ]);
                } else {
                    $cnpj = Document::create([
                        'type' => 'cnpj',
                        'value' => $request->input('cnpj'),
                    ]);
                    SupplierDocument::create([
                        'supplier_id' => $supplier->id,
                        'document_id' => $cnpj->id,
                    ]);
                }
            }
        }

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // Delete associated documents
        foreach ($supplier->documents as $document) {
            SupplierDocument::where('supplier_id', $supplier->id)
                ->where('document_id', $document->id)
                ->delete();
            $document->delete();
        }

        // Delete address if exists
        if ($supplier->address) {
            $supplier->address->delete();
        }

        // Delete supplier
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Fornecedor excluído com sucesso!');
    }
}
