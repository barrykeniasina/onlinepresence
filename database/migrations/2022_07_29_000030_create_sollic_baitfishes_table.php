<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicBaitfishesTable extends Migration
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

        $tablename = $schema . 'baitfishes';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();
            
            $table->integer('vessel_id')->nullable();
            $table->integer('fishing_month')->nullable();
            $table->integer('fishing_year')->nullable();
            $table->integer('log_id')->nullable();

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
        Schema::dropIfExists($schema.'baitfishes');
    }
}