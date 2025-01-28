@extends('layouts.base')

@section('content')
<x-form action="{{ route('suppliers.store')}}" method="post" title="Novo Fornecedor" icon="icon_save">
    <x-card-body>
        @csrf
        <div class="row">
            <div class="col-4">
                <x-select-field name="person_type" label="Tipo:">
                    <option value="legal">Pessoa Jurídica</option>
                    <option value="natural">Pessoa Física</option>
                </x-select-field>
                <x-input-field name="name" label="Razão Social:" />
            </div>
            <div class="col-4">
                <x-input-field name="trade_name" label="Nome Fantasia:" />
                <x-input-field name="cnpj" label="CNPJ:" mask="cnpj" />
                <x-input-field name="cpf" label="CPF:" mask="cpf" display="none" />
            </div>
        </div>

    </x-card-body>
    <x-card-division>
        <h2>Endereço</h2>
    </x-card-division>
    <x-card-body>
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
        <script src="{{ asset('js/supplier.js') }}" type="module"></script>
    </x-card-body>
</x-form>
@endsection