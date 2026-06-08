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
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");

            $table->string("url")->unique();
            $table->string("title");
            $table->text("description");
            $table->string("favicon");

            $table->string("custom_title")->nullable();
            $table->foreignId("category_id")->nullable()->constrained()->nullOnDelete();

            $table->timestamp("last_fetch_at")->nullable();
            $table->enum("last_health_status", ["active", "error"])->nullable();
            $table->enum("health_status", ["active", "stale", "error"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feeds');
    }
};
