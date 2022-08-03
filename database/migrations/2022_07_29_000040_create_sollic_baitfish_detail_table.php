<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSollicBaitfishDetailTable extends Migration
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

        $tablename = $schema . 'baitfish_details';
        Schema::create($tablename, function (Blueprint $table) use ($schema) {
            $table->id();

            $table->foreignId('baitfish_id')->constrained($schema.'baitfishes');
            $table->datetime('occured')->nullable()->comments('BTD_Date');
            $table->integer('act_id')->nullable();
            $table->integer('port_id')->nullable();
            $table->integer('bgr_id')->nullable();
            $table->integer('hauls')->nullable();
            $table->integer('buckets')->nullable();
            $table->integer('old_id')->nullable();

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
        Schema::dropIfExists($schema.'baitfish_detail');
        Schema::dropIfExists($schema.'baitfish_details');
    }
}