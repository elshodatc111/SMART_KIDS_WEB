<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('phone_two')->nullable();
            $table->string('address')->nullable();
            $table->integer('amount')->nullable();
            $table->date('birthday')->nullable();
            $table->string('passport_number',20)->nullable(); 
            $table->enum('type', ['drektor', 'admin', 'katta_tarbiyachi','kichik_tarbiyachi','oshpaz','teacher','farrosh','hodim'])->default('hodim');
            $table->string('type_about')->nullable();
            $table->enum('status', ['active', 'inactive','delete'])->default('active');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('phone',20)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
