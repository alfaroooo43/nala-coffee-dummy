<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketplace_clicks', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_id')->nullable();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('marketplace')->default('shopee');
            $table->string('source')->default('product_page');
            $table->string('device')->nullable();
            $table->timestamp('clicked_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();

            $table->index('visitor_id');
            $table->index('product_id');
            $table->index('clicked_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplace_clicks');
    }
};
