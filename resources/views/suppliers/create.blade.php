@extends('layouts.base')

@section('content')
<div class="card">
    <div class="card-header flex space-between">
        <div class="page-header">
            <h3>Novo Fornecedor</h3>
        </div>
        <div class="section-action">
            <button id="btn-submit" class="btn btn-primary">
                <i class="icon_save" style="color: white"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form id="main-form" action="{{ route('suppliers.store') }}" method="post" class="form-control"
            autocomplete="off" @if(isset($enctype)) enctype="multipart/form-data" @endif>
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
                    <label for="trade_name_id">Nome Fantasia:</label>
                    <input name="trade_name" type="text" id="trade_name_id">
                </div>
            </div>
        </form>
        <script defer>
            const btnSubmit = document.getElementById('btn-submit');

            const form = document.getElementById('main-form');
            btnSubmit.addEventListener('click', () => {
                form.submit();
            });

            const labelForName = document.querySelector('[for="name_id"]');
            const labelForTradeName = document.querySelector('[for="trade_name_id"]');
            const inputTradeName = document.getElementById('trade_name_id');
            const selectPersonType = document.getElementById('person_type_id');

            selectPersonType.addEventListener("change", (e) => {
                if (e.target.value === 'natural') {
                    labelForName.textContent = 'Nome:';
                    labelForTradeName.style.display = 'none';
                    inputTradeName.style.display = 'none';
                }

                if (e.target.value === 'legal') {
                    labelForName.textContent = 'Razão Social:';
                    labelForTradeName.style.display = 'block';
                    inputTradeName.style.display = 'block';
                }
            });
        </script>
    </div>
</div>
@endsection