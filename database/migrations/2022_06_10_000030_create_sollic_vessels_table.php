<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicVesselsTable extends Migration
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

        $tablename = $schema . 'vessels';
        Schema::create($tablename, function (Blueprint $table) {
            $table->id();   // previously called entryorder_id
            $table->unsignedInteger('vessel_id')->comment('');  // todo is this column needed?
            $table->unsignedInteger('uvi')->nullable()->comment('UVI also called IMO Number');
            $table->unsignedInteger('ffa_vid')->nullable()->comment('FFA Vessel Identifier');
            $table->string('solfish_id', 50)->nullable()->unquie()->comment('SOLFISH unique id for this vessel');
            $table->string('ircs', 50)->nullable()->comment('International Radio Call Sign for this vessel');
            $table->string('name', 100);
            $table->string('vty_code', 2)->nullable()->comment('');  //todo rename and foreign
            $table->string('imn', 2)->nullable()->comment('Inmarsat Mobile Number');
            $table->unsignedInteger('vms_reg_number')->nullable()->comment('');  // todo add comment for clarity
            $table->unsignedBigInteger('reg_port_id')->nullable()->comment('The Registered Port for the vessel');   // todo foreign key
            $table->string('reg_country_code', 2)->nullable()->comment('Registered Country Code - Vessel Flag');   // todo foreign key
            $table->string('reg_number', 20)->nullable()->comment('The vessels registered number given by the flag country');
            $table->string('owner_name', 120)->nullable()->comment('');
            $table->string('owner_address_1', 100)->nullable()->comment('');
            $table->string('owner_address_2', 100)->nullable()->comment('');
            $table->unsignedBigInteger('owner_address_prv_id')->nullable();   // todo better name and foreign key
            $table->string('owner_address_country_code', 2)->nullable()->comment('');   // todo foreign key

            $table->float('grt',10,2)->nullable()->comment('Gross Registered Tonnage');
            $table->float('overall_length',8,2)->nullable()->comment('');   //todo note that length is a reserved word.
            $table->unsignedSmallInteger('builtin_year')->nullable()->comment('The year the vessel was completed');
            $table->float('engine_power')->nullable()->comment('');
            $table->string('engine_power_units', 3)->nullable()->comment('');
            $table->float('fuel_capacity')->nullable()->comment('');
            $table->string('capacity_units', 2)->nullable()->comment('');
            $table->float('hold_capacity')->nullable()->comment('');
            $table->unsignedInteger('cst_id')->default(34)->comment('');   //todo foreign key
            $table->unsignedInteger('inboard_engine_count')->nullable()->comment('The number of inboard engines the vessel usually operates with');
            $table->unsignedInteger('outboard_engine_count')->nullable()->comment('The number of outboard engines the vessel usually operates with');


            $table->string('outboard_engine_power', 50)->nullable()->comment('');
            $table->string('speed', 50)->nullable()->comment('');
            $table->string('notes', 300)->nullable()->comment('');
            $table->string('image_url', 300)->nullable()->comment('');

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
        Schema::dropIfExists($schema.'vessels');
    }
}