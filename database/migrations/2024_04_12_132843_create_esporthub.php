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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); 
            $table->string('header'); 
            $table->string('description');
            $table->timestamps(); 
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); 
            $table->timestamps(); 
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique(); 
            $table->string('icon'); 
            $table->timestamps(); 
        });

        Schema::create('links', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('url')->unique(); 
            $table->timestamps(); 
        });

        Schema::create('user_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        
            $table->unique(['user_id', 'article_id']); 
        });
        
    
        // Schema::create('page_articles', function (Blueprint $table) {
        //     $table->unsignedInteger('id_page'); 
        //     $table->unsignedInteger('id_article'); 
        //     $table->timestamps();

        //     $table->foreign('id_page')->references('id')->on('pages')->onDelete('cascade');
        //     $table->foreign('id_article')->references('id')->on('articles')->onDelete('cascade');
        //     $table->primary(['id_page', 'id_article']);
        // });

        // Schema::create('article_categories', function (Blueprint $table) {
        //     $table->unsignedInteger('id_category'); 
        //     $table->unsignedInteger('id_article'); 
        //     $table->timestamps();

        //     $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
        //     $table->foreign('id_article')->references('id')->on('articles')->onDelete('cascade');
        //     $table->primary(['id_category', 'id_article']);
        // });

        // Schema::create('page_links', function (Blueprint $table) {
        //     $table->unsignedInteger('id_page'); 
        //     $table->unsignedInteger('id_link'); 
        //     $table->timestamps();

        //     $table->foreign('id_page')->references('id')->on('pages')->onDelete('cascade');
        //     $table->foreign('id_link')->references('id')->on('links')->onDelete('cascade');
        //     $table->primary(['id_page', 'id_link']);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('page_links');
        // Schema::dropIfExists('page_articles');
        Schema::dropIfExists('links');
        Schema::dropIfExists('types');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('user_articles');
    }
};
