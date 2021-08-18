@extends('layouts.app')
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    List Gems Price
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark-75">
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active" href="{{ route('gems.create') }}"><i class="fas fa-plus text-white mr-2"></i>Add new gems</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-separate table-head-custom table-checkable" id="gems" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Discount</th>
                            <th>Is Discount</th>
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
            $('#gems').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('gems.table') }}",
                columns: [
                    {data: null, "orderable": false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'title', name: 'title'},
                    {data: 'gems_amount', name: 'gems_amount'},
                    {data: 'price', name: 'price'},
                    {data: 'description', name: 'description'},
                    {data: 'discount_amount', name: 'discount_amount'},
                    {data: 'is_discount', name: 'is_discount'},
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
                        targets:-2,
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
        $('#gems').on('click', '.btn-delete[data-remote]', function (e) {
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
                        $('#gems').DataTable().draw(false);
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
