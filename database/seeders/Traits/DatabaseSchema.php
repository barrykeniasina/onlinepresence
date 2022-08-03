<?php

namespace Database\Seeders\Traits;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait DatabaseSchema
{
    public function createSchema($name)
    {
        if (!empty($name)) {
            switch (DB::getDriverName()) {
                case 'mysql': case 'pgsql':
                return  DB::statement('CREATE SCHEMA IF NOT EXISTS "' . $name . '"');

                case 'sqlite':
                    return  DB::statement("attach ':memory:' as '" . $name . "'");

                case 'sqlsrv':
                    return DB::statement("IF NOT EXISTS (SELECT * FROM sys.schemas WHERE name = N'".$name."') EXEC('CREATE SCHEMA [".$name."]')");
            }
        }
    }

    public function dropSchema($name)
    {
        if (!empty($name)) {
            switch (DB::getDriverName()) {
                case 'mysql': case 'pgsql':
                return  DB::statement('DROP SCHEMA IF EXISTS "' . $name . '"');

                case 'sqlite':
                    return  DB::statement("attach ':memory:' as '" . $name . "'");
                case 'sqlsrv':
                    return DB::statement("IF EXISTS (SELECT * FROM sys.schemas WHERE name = N'".$name."') EXEC('DROP SCHEMA [".$name."]')");
            }
        }
    }

    public function getTablename($schema, $tablename)
    {
        if (empty($schema)) {
            return $tablename;
        }
        switch (DB::getDriverName()) {
            case 'mysql': case 'pgsql': case 'sqlsrv':
            $schema = $schema.'.';
            break;
        }
        return $schema.$tablename;
    }
}
