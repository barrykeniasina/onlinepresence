<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicVesselTypesTable extends Migration
{
    const SCHEMA = CreateSollicSchema::SCHEMA;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = static::SCHEMA . '.';

        $tablename = $schema . 'vessel_types';
        Schema::create($tablename, function (Blueprint $table) {
            $table->id();   // previously called entryorder_id
            $table->string('code', 2)->unquie()->comment('The code for this vessel type.');
            $table->string('name', 50)->unquie()->comment('The name for this vessel type.');
            $table->unsignedBigInteger('vsc_id')->nullable()->comment('');   // todo foreign key
            $table->unsignedBigInteger('mfo_id')->nullable()->comment('');   // todo foreign key

            //$table->foreignId('owner_organisation_id')->constrained($schemaRef.'organisations');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $schema = static::SCHEMA. '.';
        Schema::dropIfExists($schema.'vessel_types');
    }
}