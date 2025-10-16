<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->dateTime('published_at')
                ->nullable();
            $table->unsignedBigInteger('author_id');
            $table->timestamps();

            $table->index('author_id');
            $table->index('published_at');
            $table->index(['author_id', 'published_at']);
            $table->index('created_at');

            $table->fullText(['title', 'excerpt', 'content']);

            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
