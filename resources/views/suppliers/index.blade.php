@extends('layouts.base')

@section('content')
<x-card title="Fornecedores">
    <x-card-header>
        <div class="d-flex justify-content-between align-items-center">
            <h2>Lista de Fornecedores</h2>
            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                <i class="icon_add"></i> Novo Fornecedor
            </a>
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
                                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn btn-sm btn-info">
                                        <i class="icon_visibility"></i> Ver
                                    </a>
                                    <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-sm btn-warning">
                                        <i class="icon_edit"></i> Editar
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
                                            <i class="icon_delete"></i> Excluir
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
