<?php

namespace Database\Seeders\Traits;


use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseSequence.
 */
trait DatabaseSequence
{
    /**
     * @param $table
     * @param $column
     * @param int $value
     * @return bool
     */
    protected function setSequenceValue($table, $column, int $value)
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                return  DB::statement('ALTER TABLE '.$table.' AUTO_INCREMENT='.$value);

            case 'pgsql':
                $sequence = $table.'_'.$column.'_seq';

                return  DB::statement('ALTER SEQUENCE '.$sequence.' RESTART WITH '.$value);

            case 'sqlite':
                $sequence = $table.'_'.$column.'_seq';

                return DB::statement('sqlite_sequence SET '.$sequence.' = '.$value);
        }

        return false;
    }
}