@extends('layouts.app')
@section('styles')
    <link href="{{ asset('assets/css/pages/invoice/invoice-6.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('invoice')
    <div class="card card-custom overflow-hidden">
        <div class="card-body invoice-6 p-0">
            <div class="invoice-6-container bgi-size-contain bgi-no-repeat bgi-position-y-top bgi-position-x-center" style="background-image: url({{ asset('assets/media/svg/shapes/abstract-10.svg') }});">
                <div class="container">
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-40">
                                <h1 class="display-3 font-weight-boldest text-white mb-5 mb-md-0">INVOICE</h1>
                                <div class="d-flex flex-column px-0 text-right">
                                    <span class="d-flex flex-column font-size-h5 font-weight-bold text-white align-items-center align-items-md-end">
                                        @if($order->status != 'success')
                                            <span class="label label-danger label-pill label-inline">Unpaid</span>
                                        @endif
                                        <span class="mb-2">Reciept #{{ $order->invoice }}</span>
                                        <span>{{ $order->transaction_time }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="font-weight-boldest title-color">
                                        <td class="align-middle font-size-h4 pl-0 border-0 pb-10">Product Name</td>
                                        <td class="align-middle font-size-h4 text-right border-0 pb-12">Amount</td>
                                        <td class="align-middle font-size-h4 text-right pr-0 border-0 pb-12">Price</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-size-h5 font-weight-bolder text-white">
                                        <td class="align-middle pl-0 border-0 py-4">{{ $order->gem->title }}</td>
                                        <td class="align-middle font-size-lg text-right border-0 py-4">1</td>
                                        <td class="align-middle text-right text-primary font-weight-boldest font-size-h5 pr-0 border-0 py-4">
                                            Rp. {{ rupiah_format($order->total_price) }},-
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-bottom w-100 my-13 opacity-15"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex flex-column text-white mb-5 mb-md-0">
                                        <div class="font-weight-boldest font-size-h4 mb-3 title-color">BANK TRANSFER</div>
                                        <div class="table-responsive">
                                            <table class="table font-size-h5">
                                                <tbody>
                                                <tr class="text-white">
                                                    <td class="font-weight-boldest border-0 pl-0 w-50">Username :</td>
                                                    <td class="border-0">{{ $order->user->username }}</td>
                                                </tr>
                                                <tr class="text-white">
                                                    <td class="font-weight-boldest border-0 pl-0 w-50">BANK :</td>
                                                    <td class="border-0">{{ \Str::upper($order->bank_name) }}</td>
                                                </tr>
                                                <tr class="text-white">
                                                    <td class="font-weight-boldest border-0 pl-0 w-50">VA Number :</td>
                                                    <td class="border-0">{{ $order->va_number  }}</td>
                                                </tr>
                                                <tr class="text-white">
                                                    <td class="font-weight-boldest border-0 pl-0 w-50">Status :</td>
                                                    <td class="border-0">
                                                        <span class="label label-xl label-{{ $order->status !== 'success' ? 'danger' : 'success' }} label-pill label-inline mr-2">
                                                            {{ \Str::upper($order->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table text-md-right font-weight-boldest">
                                            <tbody>
                                            <tr>
                                                <td class="align-middle title-color font-size-h4 border-0 pl-0 w-50">Subtotal</td>
                                                <td class="align-middle text-primary font-size-h2 border-0">Rp. {{ rupiah_format($order->total_price) }},-</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-end mt-30">
                                <div class="font-size-h2 font-weight-bolder text-white">Thanks For Your Order</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
