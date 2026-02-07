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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('agency_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('salesperson_id')->nullable()->constrained('salespeople')->nullOnDelete();
            $table->string('product');
            $table->foreignId('placement_id')->constrained()->cascadeOnDelete();
            $table->string('channel');
            $table->string('scope');
            $table->json('dates_booked');
            $table->decimal('amount', 12, 2)->unsigned();
            $table->decimal('discount', 12, 2)->unsigned()->default(0);
            $table->decimal('commission', 12, 2)->unsigned()->default(0);
            $table->decimal('cost_of_artwork', 12, 2)->unsigned()->default(0);
            $table->decimal('vat', 12, 2)->unsigned()->default(0);
            $table->boolean('vat_exempt')->default(false);
            $table->string('purchase_order_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
