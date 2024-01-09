<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('languages', static function (Blueprint $table): void {
            $table->uuid('id')->primary();
            $table->string('locale');
            $table->string('prefix')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
