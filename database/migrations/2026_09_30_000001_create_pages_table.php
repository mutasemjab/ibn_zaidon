<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Static content pages the mobile app reads by slug (terms, privacy,
        // about, support, …) — content only, the slug list itself is fixed
        // in code/seeder, not admin-creatable, since the app depends on it.
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->longText('body_ar')->nullable();
            $table->longText('body_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
