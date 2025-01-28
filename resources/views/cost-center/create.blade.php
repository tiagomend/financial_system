@extends('layouts.base')

@section('content')
<x-form action="{{ route('costcenter.store')}}" method="post" title="Novo Centro de Custo" icon="icon_save">
    <x-card-body>
        @csrf
        <div class="row">
            <div class="col-4">
                <x-input-field name="name" label="Nome do Centro de Custo:" mask="upper" />
                <x-input-field name="budget" label="Orçamento:" mask="money" />
                <x-select-field name="cost_center_type" label="Tipo:">
                    <option value="project">Projeto</option>
                    <option value="department">Departamento</option>
                </x-select-field>
            </div>
        </div>
    </x-card-body>
</x-form>
<script src="{{ asset('/js/costcenter.js') }}" type="module"></script>
@endsection