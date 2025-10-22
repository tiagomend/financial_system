@extends('layouts.base')

@section('content')
<x-card title="Detalhes do Fornecedor">
    <x-card-header>
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{ $supplier->name }}</h2>
            <div>
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">
                    <i class="icon_edit"></i> Editar
                </a>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    <i class="icon_arrow_back"></i> Voltar
                </a>
            </div>
        </div>
    </x-card-header>
    <x-card-body>
        <div class="row">
            <div class="col-4">
                <strong>Razão Social:</strong>
                <p>{{ $supplier->name }}</p>
            </div>
            <div class="col-4">
                <strong>Nome Fantasia:</strong>
                <p>{{ $supplier->trade_name }}</p>
            </div>
            <div class="col-4">
                <strong>Tipo:</strong>
                <p>{{ $supplier->person_type->label() }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <strong>Documento:</strong>
                <p>
                    @if($supplier->documents->count() > 0)
                        {{ strtoupper($supplier->documents->first()->type) }}: {{ $supplier->documents->first()->value }}
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </x-card-body>

    @if($supplier->address)
        <x-card-division>
            <h2>Endereço</h2>
        </x-card-division>
        <x-card-body>
            <div class="row">
                <div class="col-4">
                    <strong>Tipo de Logradouro:</strong>
                    <p>{{ ucfirst($supplier->address->street_type) }}</p>
                </div>
                <div class="col-4">
                    <strong>Nome da Rua:</strong>
                    <p>{{ $supplier->address->street }}</p>
                </div>
                <div class="col-4">
                    <strong>Número:</strong>
                    <p>{{ $supplier->address->number }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong>Bairro:</strong>
                    <p>{{ $supplier->address->neighborhood }}</p>
                </div>
                <div class="col-4">
                    <strong>CEP:</strong>
                    <p>{{ $supplier->address->postal_code }}</p>
                </div>
                <div class="col-4">
                    <strong>Cidade:</strong>
                    <p>{{ $supplier->address->city }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <strong>Estado:</strong>
                    <p>{{ $supplier->address->state }}</p>
                </div>
                <div class="col-4">
                    <strong>País:</strong>
                    <p>{{ $supplier->address->country }}</p>
                </div>
            </div>
        </x-card-body>
    @endif
</x-card>
@endsection
