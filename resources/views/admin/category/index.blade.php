
@extends('layouts.backend.app')

@section('title', 'Admin Category')

@push('css')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

@endpush





@section('content')
<div class="container-fluid">
    <div class="block-header">
    <a class="btn btn-primary waves-effect" href="{{ route('admin.category.create') }}">
        <i class="material-icons">add</i>
        <span>Add New Category</span>    
    </a>

    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Categories
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-xs btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button onclick="deleteCategory({{ $category->id }})" class="btn btn-xs btn-danger wages-effect">
                                            <i class="material-icons">delete</i>
                                        </button>

                                        <form method="POST" id="delete-form-{{ $category->id}}" style="display: none" action="{{ route('admin.category.destroy', $category->id) }}">
                                            @csrf
                                            @method('DELETE')

                                        </form>
                                    </td>
                                </tr>
                                @endforeach                         
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection



    @push('js')

        <!-- Jquery DataTable Plugin Js -->
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        {{-- jquery datatable --}}
        <script src="{{ asset('assets/backend') }}/js/pages/tables/jquery-datatable.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.5/dist/sweetalert2.all.min.js"></script>
        <script>
            function deleteCategory(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
            }
        </script>
    @endpush