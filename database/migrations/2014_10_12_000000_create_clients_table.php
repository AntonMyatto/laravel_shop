<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('country_code', 3);
            $table->string('push_token')->nullable();
            $table->boolean('send_push')->default(false);
            $table->timestamp('expired_premium_at')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->boolean('is_removed')->default(false);
            $table->integer('sms_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
