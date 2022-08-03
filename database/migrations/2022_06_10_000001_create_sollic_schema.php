<?php

use Illuminate\Database\Migrations\Migration;
use \Database\Seeders\Traits\DatabaseSchema;

class CreateSollicSchema extends Migration
{
    use DatabaseSchema;

    const SCHEMA = "sollic";

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createSchema(static::SCHEMA);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropSchema(static::SCHEMA);
    }
}