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
            // Ma'lumoti
            $table->enum('education_level',['College', 'Bachelor', 'Master', 'Doctor']); // Bakalavr, Magistr...
            $table->text('education_detail');  // Qaysi OTM, yo'nalish            
            // Ish tajribasi
            $table->string('previous_company')->nullable(); // Oldingi ishlagan joyi
            $table->string('position_applied')->nullable(); // Oldingi ishlagan joyidagi lavozim
            $table->string('years_of_experience')->nullable(); // Ish tajribasi yillari
            $table->text('career_objective')->nullable(); // Ishlashdan maqsadi      
            $table->string('expected_salary')->nullable(); // Qancha maosh kutyapsiz          
            // Qo'shimcha
            $table->enum('gender', ['male', 'female']); // Jinsi
            $table->enum('status', ['new', 'pending', 'success', 'canceled'])->default('new'); // 'new', 'pending', 'success', 'canceled'      
            // Boshqaruv
            $table->text('admin_note')->nullable(); // HR uchun izohlar
            // Lead uchun qo'shimcha maydonlar
            $table->enum('vacance_about', ['social_media', 'friend', 'other'])->nullable(); // Biz haqimizda Qaterdan malumot oldingiz
            $table->string('vacance_about_other')->nullable(); // Biz haqimizda Qaterdan malumot oldingiz (other uchun)
            $table->enum('vacance_looking_for', ['job', 'career_growth', 'experience', 'other'])->nullable(); // Nima uchun ish qidiryapsiz
            $table->string('vacance_looking_for_other')->nullable(); // Nima uchun ish qidiryapsiz (other uchun)
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('lead_emploes');
    }
};
