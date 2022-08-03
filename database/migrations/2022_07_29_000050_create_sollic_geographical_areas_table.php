<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicGeographicalAreasTable extends Migration
{
//    const SCHEMA = CreateSollicSchema::SCHEMA;
    const SCHEMA = "sollic";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schema = static::SCHEMA . '.';

        $tablename = $schema . 'geographical_areas';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();
            
            $table->string('geographical_code', 4);
            $table->char('country_code', 2)->nullable();
            $table->integer('mzt_id');
            $table->string('geographical_description', 100)->nullable();


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
        Schema::dropIfExists($schema.'geographical_areas');
      
    }
}