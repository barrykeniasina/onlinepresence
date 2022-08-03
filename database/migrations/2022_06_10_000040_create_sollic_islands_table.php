<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicIslandsTable extends Migration
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

        $tablename = $schema . 'islands';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();
            $table->string('name', 100);
            $table->integer('provence_id')->nullable();
            ///$table->foreignId('provence_id')->constrained($schema.'provences');  // todo

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
        Schema::dropIfExists($schema.'islands');
    }
}