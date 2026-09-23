<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_visits', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('page')->nullable();
            $table->string('referrer')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('ip_hash')->nullable();
            $table->timestamp('visited_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->index('visitor_id');
            $table->index('session_id');
            $table->index('visited_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_visits');
    }
};
