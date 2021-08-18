@extends('layouts.app')
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column mt-5">
                    <span class="card-label font-weight-bolder text-dark mb-1">Items</span>
                    <span class="text-muted mt-2 font-weight-bold font-size-sm">{{ $items }} Total items found.</span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('product.index') }}"><i class="far fa-list-alt text-white mr-2"></i>Product List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('item.create') }}"><i class="fas fa-plus text-white mr-2"></i>New Item</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-separate table-head-custom table-checkable" id="items" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Itemname</th>
                            <th>Price</th>
                            <th>Product Parent</th>
                            <th>Stock</th>
                            <th>Icon</th>
                            <th>Limited</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#items').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('item.list.table') }}",
                columns: [
                    {data: null, "orderable": false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'product.name', name: 'product.name'},
                    {data: 'stock', name: 'stock'},
                    {data: 'icon', name: 'icon', orderable: false,},
                    {data: 'is_limited', name: 'is_limited'},
                    {data: 'is_published', name: 'is_published'},
                    {data: 'action', name: 'action', responsivePriority: -1},
                ],
                columnDefs: [
                    {
                        width: '90px',
                        targets: -1,
                        title: 'Actions',
                        orderable: false,
                    },
                    {
                        targets: [-3, -2],
                        width: '10px',
                        render: function(data) {
                            var status = {
                                true: {'title': 'TRUE', 'class': 'label-success'},
                                false: {'title': 'FALSE', 'class': 'label-danger'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label ' + status[data].class + ' label-inline label-sm font-weight-bold text-white">' + status[data].title + '</span>';
                        },
                    },
                ]
            });
        });
        $('#items').on('click', '.btn-delete[data-remote]', function (e) {
            var url = $(this).data("remote");
            var name = $(this).data("name");
            Swal.fire({
                title: `Are you sure want delete "${name}"?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: 'DELETE', _token:"{{ csrf_token() }}", submit: true}
                    }).always(function (data) {
                        location.reload();
                        // $('#items').DataTable().draw(false);
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
