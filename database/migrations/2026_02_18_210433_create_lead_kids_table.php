<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('lead_kids', function (Blueprint $table) {
            $table->id();// Bola haqida ma'lumot
            $table->string('child_full_name');
            $table->string('certificate_serial')->unique(); // String va Unique bo'lishi shart!
            $table->enum('gender', ['male', 'female']);   
            $table->date('tkun');         
            // Ota-ona haqida ma'lumot
            $table->string('parent_full_name');
            $table->string('phone1', 20); // Asosiy raqam
            $table->string('phone2', 20)->nullable(); // Qo'shimcha raqam
            $table->string('address');           
            // Marketing va Boshqaruv
            $table->enum('status', ['new','pending','success','canceled'])->default('new');
            $table->enum('source', ['instagram', 'telegram', 'friend', 'other'])->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_kids');
    }
};
