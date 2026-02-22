<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('hodim_davomads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('attendance_date');
            $table->enum('status',['keldi','kelmadi','kechikdi'])->default('kelmadi');
            $table->foreignId('created_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('hodim_davomads');
    }
};
