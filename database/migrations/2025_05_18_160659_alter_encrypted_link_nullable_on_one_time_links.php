<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('one_time_links', function (Blueprint $table) {
        $table->text('encrypted_link')->nullable()->change();
    });
}

public function down()
{
    Schema::table('one_time_links', function (Blueprint $table) {
        $table->text('encrypted_link')->nullable(false)->change();
    });
}

};
