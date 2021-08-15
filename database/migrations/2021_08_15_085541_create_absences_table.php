<?php

use App\Models\AbsenceType;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id();
            $table->timestamp('from');
            $table->timestamp('to');
            $table->boolean('time_included');
            $table->foreignIdFor(AbsenceType::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(User::class, 'approved_by_id')->nullable();
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
        Schema::dropIfExists('absences');
    }
}
