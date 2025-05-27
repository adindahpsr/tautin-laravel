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
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->text('link')->nullable();
            $table->text('encrypted_link')->nullable();
            $table->string('code', 100)->unique();
            $table->string('creator_ip', 45);
            $table->integer('hits')->default(0);
            $table->timestamp('expired_at')->nullable();
            $table->text('qr_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_links');
    }
};