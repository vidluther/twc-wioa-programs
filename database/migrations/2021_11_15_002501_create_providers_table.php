<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('twc_id');
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->integer('provider_type');
//            $table->enum('type', array(
//                        'Higher Ed - Associates',
//                        'Higher Ed - BA',
//                        'Higher Ed - CC',
//                        'National Apprenticeship',
//                        'Private - for Profit',
//                        'Private - Non Profit',
//                        'Public',
//                        'Other'
//                ));
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
