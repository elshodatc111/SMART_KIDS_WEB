<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('moliyas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash', 15, 0)->default(0);
            $table->decimal('card', 15, 0)->default(0);
            $table->decimal('bank', 15, 0)->default(0);
            $table->decimal('pending_card', 15, 0)->default(0); 
            $table->decimal('pending_bank', 15, 0)->default(0);
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('moliyas');
    }
};
