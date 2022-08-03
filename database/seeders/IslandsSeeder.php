<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class IslandSeeder.
 */
class IslandsSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    const SCHEMA = 'sollic';

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $schema = IslandsSeeder::SCHEMA . '.' ;
        $tablename = $schema . 'islands';
        $this->disableForeignKeys();
        $this->truncate($tablename);
        $json = File::get(base_path().'/database/data/sollic/Islands.json');
        $islands = json_decode($json)->RECORDS;

        DB::unprepared('SET IDENTITY_INSERT '. $tablename. ' ON');
        foreach ($islands as $island) {
            if (isset($island->ISL_Id)) {
                if (empty( $island->ISL_PRV_Id)) {
                    $this->command->info('    Seeding island : '.json_encode($island));
                }
                DB::table($tablename)->insert([
                    'id' => $island->ISL_Id,
                    'name' => $island->ISL_Name,
                    'provence_id' => $island->ISL_PRV_Id,
                    'created_by' => 1, 'updated_by' => 1
                ]);
            }
        }
        $nextIdentityValue = DB::table($tablename)->max('id');
        ++$nextIdentityValue;
        $this->command->info('    Indexing island : '.$nextIdentityValue);
        DB::unprepared('DBCC CHECKIDENT (\''.$tablename.'\', RESEED, '.$nextIdentityValue.')');
        DB::unprepared('SET IDENTITY_INSERT '. $tablename. ' OFF');
        $this->enableForeignKeys();
    }
}
