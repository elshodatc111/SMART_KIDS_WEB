<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('moliya_histories', function (Blueprint $table) {
            $table->id();
            $table->enum("type", ['tulov','xarajat','KassaToBalans','BalansToKassa','daromad']);
            $table->decimal("amount", 15, 0);
            $table->enum("payment_method", ['cash', 'card', 'bank'])->nullable();
            $table->string("description");
            $table->enum("status", ['pending', 'success', 'canceled'])->default('pending');
            $table->date('start_date');
            $table->unsignedBigInteger("meneger_id")->constrained('users')->onDelete('cascade');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger("admin_id")->constrained('users')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('moliya_histories');
    }
};
