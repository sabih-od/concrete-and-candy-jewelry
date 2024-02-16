<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->timestamp('return_date')->nullable();
            $table->longText('return_reason')->nullable();
            $table->integer('return_qty')->nullable();
            $table->dropColumn('size');
            $table->integer('size_id')->nullable();
            $table->string('invoice_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('return_reason', 'return_date', 'return_qty', 'invoice_number', 'size_id');
        });
    }
}
