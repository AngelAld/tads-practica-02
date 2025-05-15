@extends('adminlte::page')
@section('title', 'Productos')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Lista de productos</h3>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editProductModal" id="btnCreateProduct">
                Agregar Producto
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered text-center" id="TablaProductos">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Familia</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['description'] }}</td>
                            <td>{{ $product['category'] }}</td>
                            <td>{{ $product['family'] }}</td>
                            <td>{{ $product['price'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editProductModal"
                                    onclick="handleEdit({{ $product['id'] }})">
                                    <i class="fas fa-edit"></i> Editar
                                </button>

                                <form id="delete-form-{{ $product['id'] }}"
                                    action="{{ route('products.destroy', $product['id']) }}" method="POST"
                                    style="display: none">
                                    @csrf @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $product['id'] }})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editProductForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('products.template.form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <script>
        $("#TablaProductos").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json",
            },
            columns: [{
                    data: "name"
                },
                {
                    data: "description"
                },
                {
                    data: "category"
                },
                {
                    data: "family"
                },
                {
                    data: "price"
                },
                {
                    data: "actions",
                },
            ],
        });

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        $('#btnCreateProduct').click(function() {
            $('#editProductModalLabel').text('Nuevo Producto');
            $('#editProductForm').trigger("reset");
            $('#editProductForm').attr('action', "{{ route('products.store') }}");
            $('#formMethod').val('POST');
        });

        function handleEdit(id) {
            const url = "{{ route('products.update', ':id') }}".replace(':id', id);
            const product = @json($products->keyBy('id'))[id];
            $('#editProductModalLabel').text('Editar Producto');
            $('#editProductForm').attr('action', url);
            $('#formMethod').val('PUT');
            $('#name').val(product.name);
            $('#description').val(product.description);
            $('#category_id').val(product.category_id);
            $('#family_id').val(product.family_id);
            $('#price').val(product.price);
            $('#editProductModal').modal('show');
        }
    </script>
@endsection
