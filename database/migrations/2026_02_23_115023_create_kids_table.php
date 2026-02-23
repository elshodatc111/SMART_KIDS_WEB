<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    
    public function up(): void{
        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->string('child_full_name');
            $table->string('certificate_serial', 20)->unique(); 
            $table->date('tkun');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('parent_full_name')->nullable();
            $table->string('phone1', 20);
            $table->string('phone2', 20)->nullable();
            $table->text('address')->nullable();
            $table->decimal('amount',15,0)->default(0);
            $table->enum('status', ['true', 'false','delete'])->default('false');
            $table->text('admin_note')->nullable();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('kids');
    }
};
