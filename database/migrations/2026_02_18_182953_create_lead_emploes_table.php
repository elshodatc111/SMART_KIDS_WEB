<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('lead_employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // name emas, full_name aniqroq
            $table->string('phone1', 20); // Aloqa uchun
            $table->string('phone2', 20)->nullable(); // Qo'shimcha aloqa
            $table->string('address');
            $table->date('date_of_birth'); // String emas, Date!            
            $table->enum('education_level',['College', 'Bachelor', 'Master', 'Doctor']); // Bakalavr, Magistr...
            $table->text('education_detail');  // Qaysi OTM, yo'nalish            
            $table->string('previous_company')->nullable(); // Oldingi ishlagan joyi
            $table->text('career_objective')->nullable(); // Ishlashdan maqsadi      
            $table->string('expected_salary')->nullable(); // Qancha maosh kutyapsiz  
            $table->string('lovozim')->default('emploes'); // Lovozim
            $table->enum('status', ['new', 'pending', 'success', 'canceled'])->default('new'); // 'new', 'pending', 'success', 'canceled'    
            $table->enum('vacance_about', ['social_media', 'friend', 'other'])->nullable(); // Biz haqimizda Qaterdan malumot oldingiz
            $table->text('admin_note')->nullable(); // HR uchun izohlar
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('lead_emploes');
    }
};
