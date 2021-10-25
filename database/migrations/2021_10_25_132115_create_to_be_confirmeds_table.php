<?php

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToBeConfirmedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_be_confirmeds', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->foreignIdFor(User::class, 'request_user_id');
            $table->string('old_value');
            $table->string('new_value');
            $table->boolean('is_confirmed')->nullable();
            $table->foreignIdFor(Notification::class, 'notification_id')->nullable();
            $table->foreignIdFor(User::class, 'confirmed_by_user_id');
            $table->string('client_id');
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
        Schema::dropIfExists('to_be_confirmeds');
    }
}
