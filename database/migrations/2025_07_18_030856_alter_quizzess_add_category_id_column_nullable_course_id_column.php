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
        Schema::table('quizzes', function (Blueprint $table) {
            $table->boolean('is_publish')->default(true)->after('many_attempt');
            $table->unsignedBigInteger('category_id')->nullable()->after('course_id');
            $table->unsignedBigInteger('course_id')->nullable()->change();

            // Add foreign key constraint if needed
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('is_publish');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->unsignedBigInteger('course_id')->change();
        });
    }
};
