<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean('visibility')->default(0);
            $table->unsignedInteger('rooms');
            $table->unsignedInteger('beds');
            $table->unsignedInteger('bathrooms');
            $table->unsignedInteger('mq');
            $table->decimal('price', 6, 2)->unsigned();
            $table->unsignedInteger('views')->nullable();
            $table->string('cover_image');
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
        Schema::dropIfExists('apartments');
    }
};