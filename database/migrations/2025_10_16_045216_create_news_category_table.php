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
        Schema::create('news_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id')->comment('ID новости');
            $table->unsignedBigInteger('category_id')->comment('ID рубрики');
            $table->timestamps();

            $table->unique(['news_id', 'category_id']);

            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_category');
    }
};
