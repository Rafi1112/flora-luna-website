@extends('layouts.app')
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">
                    Purchased Items
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table table-separate table-head-custom table-checkable" id="purchased_items" style="margin-top: 13px !important">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Username</th>
                            <th>Itemname</th>
                            <th>Icon</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
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
            $('#purchased_items').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list.item.table') }}",
                columns: [
                    {data: null, "orderable": false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'invoice', name: 'invoice'},
                    {data: 'user.username', name: 'user.username'},
                    {data: 'item.name', name: 'item.name'},
                    {data: 'icon', name: 'icon', orderable: false},
                    {data: 'amount', name: 'amount', orderable: false},
                    {data: 'price', name: 'price'},
                    {data: 'order_date', name: 'created_at'},
                    {data: 'status', name: 'status', responsivePriority: -1},
                ],
                columnDefs: [
                    {
                        targets: -1,
                        render: function(data) {
                            var status = {
                                'Pending': {'title': 'Pending', 'state': 'danger'},
                                'Success': {'title': 'Success', 'state': 'success'},
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
