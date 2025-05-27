<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('one_time_links', function (Blueprint $table) {
            $table->id();
            $table->text('link')->nullable();
            $table->text('encrypted_link')->nullable();
            $table->string('code')->unique();
            $table->string('creator_ip');
            $table->boolean('is_used')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('one_time_links');
    }
};