<?php

use Illuminate\Database\Migrations\Migration;
use \Database\Seeders\Traits\DatabaseSchema;

class CreateRefSchema extends Migration
{
    use DatabaseSchema;

    const SCHEMA = "ref";

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