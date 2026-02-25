<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('group_kids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade');
            $table->foreignId('kid_id')->constrained('kids')->onDelete('cascade');            
            $table->enum('status', ['active', 'deleted'])->default('active')->index();
            $table->string('description');
            $table->date('start_date');
            $table->foreignId('start_admin_id')->constrained('users');
            $table->date('end_date')->nullable();
            $table->foreignId('end_admin_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('group_kids');
    }
};
