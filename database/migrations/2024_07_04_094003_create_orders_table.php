<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('shipping_address_1')->nullable();
            $table->string('shipping_address_2')->nullable();
            $table->string('shipping_address_3')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->string('zip_postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
