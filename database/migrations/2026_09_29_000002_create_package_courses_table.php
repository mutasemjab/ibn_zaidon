<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The eligible pool of courses a student may choose pick_count from.
        Schema::create('package_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['package_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_courses');
    }
};
