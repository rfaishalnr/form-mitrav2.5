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
        Schema::table('boq_lines', function (Blueprint $table) {
            $table->string('id_project')->nullable()->after('sto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('boq_lines', function (Blueprint $table) {
            $table->dropColumn('id_project');
        });
    }
};