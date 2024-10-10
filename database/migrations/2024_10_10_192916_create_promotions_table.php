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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamp('from');
            $table->timestamp('to');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('promotion_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promotion_id')->constrained()->cascadeOnDelete();
            $table->string('namespace');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('promotion_rules');
    }
};
