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
        Schema::create('retrievals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('found_item_id')->constrained('found_items')->onDelete('cascade');
            $table->string('username', 255);
            $table->string('userphone', 20);
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            $table->date('retrieval_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrievals');
    }
};
