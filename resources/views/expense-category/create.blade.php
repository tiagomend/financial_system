@extends('layouts.base')

@section('content')
<x-form action="{{ route('expensecategory.store')}}" method="post" title="Nova Categoria de Despesas" icon="icon_save">
    <x-card-body>
        @csrf
        <div class="row">
            <div class="col-4">
                <x-input-field name="name" label="Nome da Categoria:" mask="upper" />
                <x-input-field name="color" label="Cor:" type="color" />
            </div>
        </div>
    </x-card-body>
</x-form>
<script src="{{ asset('/js/costcenter.js') }}" type="module"></script>
@endsection