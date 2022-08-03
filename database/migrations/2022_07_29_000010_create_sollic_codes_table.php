<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicCodesTable extends Migration
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

        $tablename = $schema . 'codes';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();
            $table->char('source_entity_code', 3);
            $table->string('name', 150);
            $table->boolean('is_current')->default(true);
            $table->string('notes', 100)->nullable();
            $table->string('memo', 250)->nullable();
            $table->integer('spc_id')->nullable();


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
        Schema::dropIfExists($schema.'codes');
    }
}