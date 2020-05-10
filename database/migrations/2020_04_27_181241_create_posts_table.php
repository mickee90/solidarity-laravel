<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('city_id')->default(1);
            $table->tinyInteger('type_id')->default(1)->comment('1 = need help, 2 = can help');
            $table->string('title');
            $table->string('ingress', 200);
            $table->text('content')->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(NULL);
            $table->string('website')->nullable()->default(NULL);
            $table->boolean('published')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
