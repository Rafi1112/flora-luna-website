@extends('layouts.app')
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Purchased Gems
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-separate table-head-custom table-checkable" id="purchases" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Username</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
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
            $('#purchases').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list.gems.table') }}",
                columns: [
                    {data: null, "orderable": false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'invoice', name: 'invoice'},
                    {data: 'user.username', name: 'user.username'},
                    {data: 'gem.title', name: 'gem.title'},
                    {data: 'price', name: 'price'},
                    {data: 'transaction_time', name: 'transaction_time'},
                    {data: 'status', name: 'status'},
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
                        targets: -2,
                        render: function(data) {
                            var status = {
                                'pending': {'title': 'PENDING', 'state': 'danger'},
                                'success': {'title': 'SUCCESS', 'state': 'success'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                        }
                    },
                ]
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endpush
