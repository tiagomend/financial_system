@extends('layouts.base')

@section('content')
<div class="card">
    <form id="main-form" action="{{ route('suppliers.store') }}" method="post" class="form-control" autocomplete="false"
        @if(isset($enctype)) enctype="multipart/form-data" @endif>
        <div class="card-header flex space-between">
            <div class="page-header">
                <i class="icon_save"></i>
                <h3>Novo Fornecedor</h3>
            </div>
            <div class="section-action">
                <button id="btn-submit" class="btn btn-primary">
                    <i class="icon_save" style="color: white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">

            @csrf
            <div class="row">
                <div class="col-4">
                    <label for="person_type_id">Tipo:</label>
                    <select name="person_type" id="person_type_id">
                        <option value="legal">Pessoa Jurídica</option>
                        <option value="natural">Pessoa Física</option>
                    </select>
                    <label for="name_id">Razão Social:</label>
                    <input name="name" type="text" id="name_id">
                </div>
                <div class="col-4">
                    <label for="trade_name_id">Nome Fantasia:</label>
                    <input name="trade_name" type="text" id="trade_name_id">
                    <label for="cnpj_id">CNPJ:</label>
                    <input name="cnpj" type="text" id="cnpj_id" data-mask="cnpj">
                    <label for="cpf_id" style="display: none">CPF:</label>
                    <input name="cpf" type="text" id="cpf_id" style="display: none" data-mask="cpf">
                </div>
            </div>

        </div>
        <div class="card-header card-division">
            <h2>Endereço</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="street_type_id">Tipo de Logradouro:</label>
                    <select name="street_type" id="street_type_id">
                        <option value="road">Rua</option>
                        <option value="avenue">Avenida</option>
                    </select>
                    <label for="street_id">Nome da rua:</label>
                    <input name="street" type="text" id="street_id">
                    <label for="number_id">Número:</label>
                    <input name="number" type="text" id="number_id">
                    <label for="neighborhood_id">Bairro:</label>
                    <input name="neighborhood" type="text" id="neighborhood_id">
                </div>
                <div class="col-4">
                    <label for="postal_code_id">CEP:</label>
                    <input name="postal_code" type="text" id="postal_code_id" data-mask="cep">
                    <label for="city_id">Cidade:</label>
                    <input name="city" type="text" id="city_id">
                    <label for="state_id">Estado:</label>
                    <input name="state" type="text" id="state_id">
                    <label for="country_id">País:</label>
                    <input name="country" type="text" id="country_id">
                </div>
            </div>
            <script defer>
                const btnSubmit = document.getElementById('btn-submit');
                const form = document.getElementById('main-form');

                const elements = {
                    labelForName: document.querySelector('[for="name_id"]'),
                    labelForTradeName: document.querySelector('[for="trade_name_id"]'),
                    inputTradeName: document.getElementById('trade_name_id'),
                    selectPersonType: document.getElementById('person_type_id'),
                    inputCpf: document.getElementById('cpf_id'),
                    inputCnpj: document.getElementById('cnpj_id'),
                    labelForCpf: document.querySelector('[for="cpf_id"]'),
                    labelForCnpj: document.querySelector('[for="cnpj_id"]')
                };

                // Submit form on button click
                btnSubmit.addEventListener('click', () => form.submit());

                // Toggle visibility and labels based on person type
                const updateFormForPersonType = (type) => {
                    const isNaturalPerson = type === 'natural';

                    elements.labelForName.textContent = isNaturalPerson ? 'Nome:' : 'Razão Social:';
                    elements.labelForTradeName.style.display = isNaturalPerson ? 'none' : 'block';
                    elements.inputTradeName.style.display = isNaturalPerson ? 'none' : 'block';
                    elements.inputCnpj.style.display = isNaturalPerson ? 'none' : 'block';
                    elements.labelForCnpj.style.display = isNaturalPerson ? 'none' : 'block';
                    elements.inputCpf.style.display = isNaturalPerson ? 'block' : 'none';
                    elements.labelForCpf.style.display = isNaturalPerson ? 'block' : 'none';
                };

                // Add event listener to selectPersonType
                elements.selectPersonType.addEventListener('change', (e) => {
                    updateFormForPersonType(e.target.value);
                });

                // Masks
                const cepMask = () => {
                    const elements = [...document.querySelectorAll('[data-mask="cep"]')];
                    elements.forEach(element => {
                        element.addEventListener('input', () => {
                            let value = element.value.replace(/\D/g, "");
                            value = value.slice(0, 8);
                            if (value.length > 5) {
                                value = value.replace(/^(\d{5})(\d)/, "$1-$2");
                            }
                            element.value = value;
                        });
                    });
                }

                cepMask();

                const cpfMask = () => {
                    const elements = [...document.querySelectorAll('[data-mask="cpf"]')];
                    elements.forEach(element => {
                        element.addEventListener('input', () => {
                            let value = element.value.replace(/\D/g, "");
                            value = value.slice(0, 11);
                            if (value.length > 9) {
                                value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d)/, "$1.$2.$3-$4");
                            }
                            if (value.length > 6) {
                                value = value.replace(/^(\d{3})(\d{3})(\d)/, "$1.$2.$3");
                            }
                            if (value.length > 3) {
                                value = value.replace(/^(\d{3})(\d)/, "$1.$2");
                            }
                            element.value = value;
                        });
                    });
                }

                cpfMask();

                const cnpjMask = () => {
                    const elements = [...document.querySelectorAll('[data-mask="cnpj"]')];
                    elements.forEach(element => {
                        element.addEventListener('input', () => {
                            let value = element.value.replace(/\D/g, "");
                            value = value.slice(0, 14);
                            if (value.length > 12) {
                                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d)/, "$1.$2.$3/$4-$5");
                            }
                            if (value.length > 8) {
                                value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d)/, "$1.$2.$3/$4");
                            }
                            if (value.length > 5) {
                                value = value.replace(/^(\d{2})(\d{3})(\d)/, "$1.$2.$3");
                            }
                            if (value.length > 2) {
                                value = value.replace(/^(\d{2})(\d)/, "$1.$2");
                            }
                            element.value = value;
                        });
                    });
                }

                cnpjMask();
            </script>
        </div>
    </form>
</div>
@endsection