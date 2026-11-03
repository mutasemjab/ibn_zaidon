<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE cards MODIFY activation_type ENUM('course','teacher','price','package') NOT NULL DEFAULT 'price'");

        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('linked_package_id')->nullable()->after('linked_teacher_id');
            $table->foreign('linked_package_id')->references('id')->on('packages')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropForeign(['linked_package_id']);
            $table->dropColumn('linked_package_id');
        });

        DB::statement("ALTER TABLE cards MODIFY activation_type ENUM('course','teacher','price') NOT NULL DEFAULT 'price'");
    }
};
