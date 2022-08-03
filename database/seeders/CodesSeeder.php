<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class CodesSeeder.
 */
class CodesSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    const SCHEMA = 'sollic';

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $schema = static::SCHEMA . '.' ;
        $tablename = $schema . 'codes';
        $this->disableForeignKeys();
        $this->truncate($tablename);
        $json = File::get(base_path().'/database/data/sollic/Codes.json');
        $codes = json_decode($json)->RECORDS;

        DB::unprepared('SET IDENTITY_INSERT '. $tablename. ' ON');
        foreach ($codes as $code) {
            if (isset($code->Id)) {
                DB::table($tablename)->insert([
                    'id' => $code->Id,
                    'source_entity_code' => $code->Source_Entity_Code,
                    'name' => $code->Code_Name,
                    'is_current' => ($code->Code_Current == '1'),
                    'notes' => $code->Code_Notes,
                    'memo' => $code->Code_Memo,
                    'created_by' => 1, 'updated_by' => 1
                ]);
            }
        }
        $nextIdentityValue = DB::table($tablename)->max('id');
        ++$nextIdentityValue;
        $this->command->info('    Indexing codes : '.$nextIdentityValue);
        DB::unprepared('DBCC CHECKIDENT (\''.$tablename.'\', RESEED, '.$nextIdentityValue.')');
        DB::unprepared('SET IDENTITY_INSERT '. $tablename. ' OFF');
        $this->enableForeignKeys();
    }
}
