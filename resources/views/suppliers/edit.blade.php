@extends('layouts.base')

@section('content')
<x-form action="{{ route('suppliers.update', $supplier->id)}}" method="post" title="Editar Fornecedor" icon="icon_save">
    <x-card-body>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4">
                <x-select-field name="person_type" label="Tipo:">
                    <option value="legal" {{ $supplier->person_type->value === 'legal' ? 'selected' : '' }}>Pessoa Jurídica</option>
                    <option value="natural" {{ $supplier->person_type->value === 'natural' ? 'selected' : '' }}>Pessoa Física</option>
                </x-select-field>
                <x-input-field name="name" label="Razão Social:" value="{{ $supplier->name }}" />
            </div>
            <div class="col-4">
                <x-input-field name="trade_name" label="Nome Fantasia:" value="{{ $supplier->trade_name }}" />
                @php
                    $document = $supplier->documents->first();
                    $cnpjValue = $document && $document->type === 'cnpj' ? $document->value : '';
                    $cpfValue = $document && $document->type === 'cpf' ? $document->value : '';
                    $cnpjDisplay = $supplier->person_type->value === 'legal' ? 'block' : 'none';
                    $cpfDisplay = $supplier->person_type->value === 'natural' ? 'block' : 'none';
                @endphp
                <x-input-field name="cnpj" label="CNPJ:" mask="cnpj" value="{{ $cnpjValue }}" display="{{ $cnpjDisplay }}" />
                <x-input-field name="cpf" label="CPF:" mask="cpf" value="{{ $cpfValue }}" display="{{ $cpfDisplay }}" />
            </div>
        </div>
    </x-card-body>
    <x-card-division>
        <h2>Endereço</h2>
    </x-card-division>
    <x-card-body>
        @if($supplier->address)
            <div class="row">
                <div class="col-4">
                    <x-select-field name="street_type" label="Tipo de Logradouro:">
                        <option value="road" {{ $supplier->address->street_type === 'road' ? 'selected' : '' }}>Rua</option>
                        <option value="avenue" {{ $supplier->address->street_type === 'avenue' ? 'selected' : '' }}>Avenida</option>
                    </x-select-field>
                    <x-input-field name="street" label="Nome da Rua:" value="{{ $supplier->address->street }}" />
                    <x-input-field name="number" label="Número:" value="{{ $supplier->address->number }}" />
                    <x-input-field name="neighborhood" label="Bairro:" value="{{ $supplier->address->neighborhood }}" />
                </div>
                <div class="col-4">
                    <x-input-field name="postal_code" label="CEP:" mask="cep" value="{{ $supplier->address->postal_code }}" />
                    <x-input-field name="city" label="Cidade:" value="{{ $supplier->address->city }}" />
                    <x-input-field name="state" label="Estado:" value="{{ $supplier->address->state }}" />
                    <x-input-field name="country" label="País:" value="{{ $supplier->address->country }}" />
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-4">
                    <x-select-field name="street_type" label="Tipo de Logradouro:">
                        <option value="road">Rua</option>
                        <option value="avenue">Avenida</option>
                    </x-select-field>
                    <x-input-field name="street" label="Nome da Rua:" />
                    <x-input-field name="number" label="Número:" />
                    <x-input-field name="neighborhood" label="Bairro:" />
                </div>
                <div class="col-4">
                    <x-input-field name="postal_code" label="CEP:" mask="cep" />
                    <x-input-field name="city" label="Cidade:" />
                    <x-input-field name="state" label="Estado:" />
                    <x-input-field name="country" label="País:" />
                </div>
            </div>
        @endif
        <script src="{{ asset('js/supplier.js') }}" type="module"></script>
    </x-card-body>
</x-form>
@endsection
