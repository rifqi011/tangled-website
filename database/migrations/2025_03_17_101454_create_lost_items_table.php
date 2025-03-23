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
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('username', 255);
            $table->string('userphone', 20);
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->string('last_location', 255);
            $table->text('description');
            $table->string('photo', 255)->nullable();
            $table->date('lost_date');
            $table->enum('status', ['diproses', 'hilang', 'disimpan', 'diambil'])->default('diproses');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
