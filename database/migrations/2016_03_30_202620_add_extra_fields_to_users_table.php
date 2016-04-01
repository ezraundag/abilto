<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('username')->nullable()->unique();
            $table->text('first_name')->nullable();
            $table->text('surname')->nullable();
            $table->string('name')->nullable()->change();
            $table->text('post_id')->nullable()->index();
            $table->text('comment_id')->nullable()->index();
            $table->string('user_session_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           
        });
    }
}
