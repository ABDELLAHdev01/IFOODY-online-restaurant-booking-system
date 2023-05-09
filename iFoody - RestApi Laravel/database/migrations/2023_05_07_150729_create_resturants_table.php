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
        Schema::create('resturants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('image');
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('availability');
            $table->string('approval');
            $table->softDeletes();
            $table->unsignedBigInteger('manger_id');
            $table->foreign('manger_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resturants');
    }
};
