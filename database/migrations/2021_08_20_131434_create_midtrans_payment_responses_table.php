<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMidtransPaymentResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midtrans_payment_responses', function (Blueprint $table) {
            $table->id();
            $table->string('va_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('transaction_time')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status_message')->nullable();
            $table->string('status_code')->nullable();
            $table->string('signature_key')->nullable();
            $table->string('settlement_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_amounts')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('amount')->nullable();
            $table->string('order_id')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('fraud_status')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('midtrans_payment_responses');
    }
}
