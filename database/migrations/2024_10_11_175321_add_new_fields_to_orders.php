<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_type');
            $table->string('address');
            $table->string('note')->nullable();
            $table->integer('total');
            $table->dropColumn('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_type');
            $table->dropColumn('address');
            $table->dropColumn('note');
            $table->dropColumn('total');
        });
    }
};
