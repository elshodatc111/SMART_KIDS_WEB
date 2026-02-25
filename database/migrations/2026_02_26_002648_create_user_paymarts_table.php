<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('user_paymarts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 15, 0);
            $table->enum('payment_method', ['cash', 'card', 'bank'])->default('cash');
            $table->string('description');
            $table->unsignedBigInteger("admin_id")->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('user_paymarts');
    }
};
