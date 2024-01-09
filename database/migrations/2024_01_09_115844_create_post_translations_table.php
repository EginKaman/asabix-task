<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('post_translations', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->foreignUuid('post_id')->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('language_id')->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description')->nullable();
            $table->mediumText('content')->nullable();

            $table->unique(['post_id', 'language_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_translations');
    }
};
