<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicWardsTable extends Migration
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

        $tablename = $schema . 'wards';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();

            $table->string('name', 50);
            $table->foreignId('provence_id')->constrained($schema.'codes');
            $table->integer('original_code')->nullable();
            $table->unsignedFloat('area_sqkm', 18, 1)->nullable();
            $table->float('midpoint_lat', 18, 6)->nullable();
            $table->float('midpoint_lon', 18, 6)->nullable();

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
        Schema::dropIfExists($schema.'wards');
    }
}