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
    Schema::create('todos', function (Blueprint $table) {
        $table->id();
        $table->string('task'); // Kolom untuk isi tugas
        $table->boolean('is_completed')->default(false); // Status tugas
        $table->timestamps(); // Kolom created_at & updated_at otomatis
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
