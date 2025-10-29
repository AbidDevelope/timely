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
        Schema::create('user_goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('profession_id');
            $table->unsignedBigInteger('income_range_id');
            $table->unsignedBigInteger('age_group_id');
            $table->unsignedBigInteger('payment_mode_id');
            $table->unsignedBigInteger('plan_id');
            $table->decimal('estimated_investment', 10, 2);
            $table->decimal('monthly_savings', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_goals');
    }
};
