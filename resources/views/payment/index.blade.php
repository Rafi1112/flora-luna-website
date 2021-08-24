@extends('layouts.app')

@section('content')
    <div class="flex-row-fluid col-xl-8">
        <div class="card card-custom example example-compact">
            <div class="card-header">
                <h3 class="card-title">Purchase Gems</h3>
            </div>
            <form class="form" action="{{ route('payment') }}" method="POST">
                @csrf
                <div class="card-body">
                    @error('gem')
                        <div class="alert alert-danger" role="alert">Select gems at least one!</div>
                    @enderror
                    @error('payment_method')
                        <div class="alert alert-danger" role="alert">Please select the payment method!</div>
                    @enderror
                    <div class="form-group m-0">
                        <label>Choose Gems Box :</label>
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach($gems as $gem)
                                    <label class="option">
                                    <span class="option-control">
                                        <span class="radio">
                                            <input type="radio" name="gem" id="gem" value="{{ $gem->id }}" />
                                            <span></span>
                                        </span>
                                    </span>
                                        <span class="option-label">
                                        <span class="option-head">
                                            <span class="option-title">{{ $gem->title }}</span>
                                            <span class="option-focus">
                                                @if($gem->is_discount)
                                                    <span class="text-danger">
                                                        Rp. {{ rupiah_format(discount_price($gem->price, $gem->discount_amount)) }},-
                                                    </span>
                                                        &nbsp; <span class="text-muted"><s>Rp. {{ rupiah_format($gem->price) }},-</s>
                                                    </span>
                                                @else
                                                    Rp. {{ rupiah_format($gem->price) }},-
                                                @endif
                                            </span>
                                        </span>
                                        <span class="option-body">{{ $gem->description }}</span>
                                    </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-8"></div>
                    <div class="form-group">
                        <label>Choose Payment Method :</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="option">
                                    <span class="option-control">
                                        <span class="radio">
                                            <input type="radio" name="payment_method" id="payment_method" value="bca" />
                                            <span></span>
                                        </span>
                                    </span>
                                    <span class="option-label">
                                        <span class="option-head">
                                            <span class="option-title">BCA Virtual Account</span>
                                        </span>
                                        <span class="option-body">Virtual Account Number will display.</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="option">
                                    <span class="option-control">
                                        <span class="radio">
                                            <input type="radio" name="payment_method" id="payment_method" value="bri" />
                                            <span></span>
                                        </span>
                                    </span>
                                    <span class="option-label">
                                        <span class="option-head">
                                            <span class="option-title">BRI Virtual Account</span>
                                        </span>
                                        <span class="option-body">Virtual Account Number will display.</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="option">
                                    <span class="option-control">
                                        <span class="radio">
                                            <input type="radio" name="payment_method" id="payment_method" value="bni" />
                                            <span></span>
                                        </span>
                                    </span>
                                    <span class="option-label">
                                        <span class="option-head">
                                            <span class="option-title">BNI Virtual Account</span>
                                        </span>
                                        <span class="option-body">Virtual Account Number will display.</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2 checkout">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
            $('.checkout').click(function (e) {
                var form =  $(this).closest("form");
                Swal.fire({
                    title: `Are you sure want continue this payment?`,
                    text: "Payment confirmation automatically by system.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.value) {
                        Swal.fire(
                            "Yaayyy!",
                            "Please wait a sec, we'll creating your payment.",
                            "success"
                        )
                        form.submit();
                    } else if (result.dismiss === "cancel") {
                        Swal.fire(
                            "Cancelled",
                            "You cancelled the payment :'(",
                            "error"
                        )
                    }
                });
                e.preventDefault();
            });
        });
    </script>
@endpush

