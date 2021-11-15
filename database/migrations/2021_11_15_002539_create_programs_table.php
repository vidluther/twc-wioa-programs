<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('twc_id');
            $table->integer('provider'); // need to learn how to make this a FK to Provider model
            $table->string('name');
            $table->string('description');
            $table->enum('pell_eligible', array('Yes', 'No'));
            $table->longText('pre_reqs');
            $table->string('url');
            $table->string('outcome');
            $table->string('assoc_credential_name');
            $table->integer('length_hours');
            $table->integer('length_weeks');
            $table->longText('format');
            $table->integer('code_1');
            $table->integer('code_2');
            $table->integer('code_3');
            $table->integer('req_cost');
            $table->integer('num_apprentices');
            $table->dateTime('program_start_date');
            $table->dateTime('program_last_updated');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programs');
    }
}
