<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('kid_davomads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('kid_id')->constrained()->onDelete('cascade');
            $table->date('attendance_date')->index();
            $table->enum('status',['keldi','kelmadi'])->default('kelmadi');
            $table->foreignId('created_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->unique(['group_id', 'kid_id', 'attendance_date'], 'kid_attendance_unique');
        });
    }

    public function down(): void{
        Schema::dropIfExists('kid_davomads');
    }
};
