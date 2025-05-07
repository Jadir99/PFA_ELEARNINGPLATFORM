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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->text('url')->nullable();
            $table->enum('type', ['free', 'paid', 'subscription'])->default('paid');
            $table->text('instructor_names')->nullable();
            $table->foreignId('course_category_id')->constrained()->onDelete('cascade');
            $table->text('description_en')->nullable();
            $table->integer('num_subscribers')->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->integer('num_reviews')->nullable();
            $table->text('instructional_level')->nullable();
            $table->text('objectives')->nullable();
            $table->timestamps(0); // For created_at and updated_at
            $table->softDeletes(); // For deleted_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
