<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        // Add the new column after the 'description' column. It can be nullable.
        $table->string('pdf_path', 2048)->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->dropColumn('pdf_path');
    });
}
};
