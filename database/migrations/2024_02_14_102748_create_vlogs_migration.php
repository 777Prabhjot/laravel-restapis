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
        Schema::create('vlogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posted_by');
            $table->string('title');
            $table->string('desc');
            $table->foreign('posted_by')->references('id')->on('users');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vlogs_migration');
    }
};
