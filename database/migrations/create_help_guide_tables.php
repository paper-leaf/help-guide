<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('help_guide_topics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('help_guide_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('description')->nullable();
            $table->foreignId('topic_id')
                ->nullable()
                ->constrained('help_guide_topics')
                ->onDelete('set null');
            $table->string('icon')->default('heroicon-o-information-circle');
            $table->longText('content')->nullable();
            $table->string('viewable_by_role')->nullable();
            $table->timestamps();
        });
    }
};
