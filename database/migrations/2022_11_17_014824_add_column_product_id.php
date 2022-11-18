<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // $table->integer('product_id')->unsigned()->after('email');

            // $table->foreign('product_id')->references('id')->on('products');

            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->index('product_id')->nullable();
            $table->foreign('product_id')->nullable()->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
