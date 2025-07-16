<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('age')->after('email');
            $table->integer('bengali')->after('age');
            $table->integer('english')->after('bengali');
            $table->integer('math')->after('english');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['age', 'bengali', 'english', 'math']);
        });
    }
};
