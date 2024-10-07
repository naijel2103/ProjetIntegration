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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string('email')->unique();
            $table->string('password'); 
            $table->string('role')->default("aucun");
            $table->string('code', 60)->nullable();
            $table->boolean('admin')->default(false);;
            $table->boolean('verifier')->default(false);;
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
