@extends('adminlte::page')
@section('title', 'Categorías')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h3 class="card-title">Lista de categorías</h3>
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editCategoryModal" id="btnCreateCategory">
                Agregar Categoría
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered text-center" id="TablaCategorias">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Familia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category['name'] }}</td>
                            <td>{{ $category['description'] }}</td>
                            <td>{{ $category['family'] }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editCategoryModal"
                                    data-id="{{ $category['id'] }}" data-name="{{ $category['name'] }}"
                                    data-description="{{ $category['description'] }}"
                                    data-family_id="{{ $category['family_id'] }}" id="btnEditCategory">
                                    <i class="fas fa-edit"></i> Editar
                                </button>


                                <form id="delete-form-{{ $category['id'] }}"
                                    action="{{ route('categories.destroy', $category['id']) }}" method="POST"
                                    style="display: none">
                                    @csrf @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category['id'] }})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editCategoryForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Nueva Categoría</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('categories.template.form')
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
        $("#TablaCategorias").DataTable({
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
                    data: "family"
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
                console.log(result);
                if (result.value) {
                    console.log(id);
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        // Ocultar automáticamente las alertas después de 5 segundos
        setTimeout(() => {
            const alert = document.querySelector(".alert");
            if (alert) {
                alert.classList.remove("show");
                alert.classList.add("fade");
                setTimeout(() => alert.remove(), 500); // Eliminar del DOM después de la animación
            }
        }, 3000); // 3000 ms = 3 segundos





        $('#btnCreateCategory').click(function() {
            $('#editCategoryModalLabel').text('Nueva Categoría');
            $('#editCategoryForm').trigger("reset");
            $('#editCategoryForm').attr('action', "{{ route('categories.store') }}");
            $('#formMethod').val('POST');
        });

        $('')
    </script>


@endsection
