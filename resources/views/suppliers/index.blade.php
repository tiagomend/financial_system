@extends('layouts.base')

@section('content')
<x-card title="Fornecedores">
    <x-card-header>
        <div class="flex space-between">
            <div class="page-header">
                <h3>Lista de Fornecedores</h3>
            </div>
            <div class="section-action">
                <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                    <i class="icon_add" style="color: white"></i>
                </a>
            </div>
        </div>
    </x-card-header>
    <x-card-body>
        @if($suppliers->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Nome Fantasia</th>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->trade_name }}</td>
                                <td>{{ $supplier->person_type->label() }}</td>
                                <td>
                                    @if($supplier->documents->count() > 0)
                                        {{ $supplier->documents->first()->value }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-primary" title="Ver">
                                        <i class="icon_visibility"></i>
                                    </a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-secondary" title="Editar">
                                        <i class="icon_edit"></i>
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                                            <i class="icon_delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>Nenhum fornecedor cadastrado.</p>
        @endif
    </x-card-body>
</x-card>
@endsection
