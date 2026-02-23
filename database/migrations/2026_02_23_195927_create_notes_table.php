<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['kid','kid_lead','user','user_lead','group'])->default('kid');
            $table->string('text');
            $table->foreignId('type_id');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('notes');
    }
};
