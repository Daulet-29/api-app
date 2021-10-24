<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->default('');
            $table->string('destination')->default('');
            $table->mediumText('cost')->default('');
            $table->string('status')->default('В работе');
            $table->foreignIdFor(Courier::class)->default('');
            $table->timestamp('order_acceptance_date')->useCurrent();
            $table->timestamp('order_delivery_date')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
