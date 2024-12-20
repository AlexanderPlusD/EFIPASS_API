<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recharges', function (Blueprint $table) {
            $table->id(); 
            $table->double('balance'); 
            $table->unsignedInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('activeRecharge')->default(1);
            $table->boolean('statusRecharge')->default(1);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recharges');
    }
};
