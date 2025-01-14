<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignID('category_id')->constrained()->cascadeOnDelete();
            $table->string('first_name',20);
            $table->string('last_name',20);
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email');
            $table->string('tell', 11);
            $table->string('address',255)
            $table->string('building',255);
            $table->text('detail');
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
        Schema::dropIfExists('contacts');
    }
}
