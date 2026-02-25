<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->decimal('group_amount',15,0)->default(0);
            $table->string('description')->nullable();
            $table->unsignedBigInteger("meneger_id")->constrained('users')->onDelete('cascade');
            $table->string('status')->default('active','deleted');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('groups');
    }
};
