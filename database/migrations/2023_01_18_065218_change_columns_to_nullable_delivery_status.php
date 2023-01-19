<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('delivery_statuses', function (Blueprint $table) {
            $table->string('product_name')->nullable()->change();
            $table->string('buyer_name')->nullable()->change();
            $table->string('courier_name')->nullable()->change();
            $table->string('status')->nullable()->change()->default('Pending');
        });
    }
};
