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
        Schema::create('group_paymarts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kid_id')->constrained('kids')->onDelete('cascade');
            $table->unsignedBigInteger('group_id')->constrained('groups')->onDelete('cascade');
            $table->date('monch');
            $table->decimal('amount',15,0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_paymarts');
    }
};
