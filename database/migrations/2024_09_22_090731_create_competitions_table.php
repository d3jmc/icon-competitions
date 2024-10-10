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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('thumbnail');
            $table->timestamp('start_date');
            $table->timestamp('started_on')->nullable();
            $table->timestamp('end_date');
            $table->timestamp('ended_on')->nullable();
            $table->float('ticket_price');
            $table->integer('min_tickets');
            $table->integer('max_tickets');
            $table->integer('min_tickets_per_user')->default(1);
            $table->integer('max_tickets_per_user')->default(-1);
            $table->integer('instant_wins')->default(0);
            $table->boolean('choose_winner')->default(false);
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('prizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->float('credit')->default(0);
            $table->integer('available')->default(0);
            $table->integer('assigned')->default(0);
            $table->string('assign_to_ticket_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('prize_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('status');
            $table->timestamp('reserved_on')->nullable();
            $table->timestamp('claimed_on')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
        Schema::dropIfExists('prizes');
        Schema::dropIfExists('tickets');
    }
};
