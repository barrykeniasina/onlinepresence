<?php

namespace Database\Seeders;


use App\Domains\Ref\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class CountriesSeeder
 *
 * Acknowledgement:
 * Originally sourced from https://github.com/webpatser/laravel-countries
 */
class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tablename = with(new Country())->getTable();

        //Empty the countries table
        DB::table($tablename)->delete();

        //Get all of the countries
        //$countries = (new Countries())->getList();
        $json = File::get(base_path().'/database/data/ref/countries.json');
        $countries = json_decode($json);

        foreach ($countries as $countryId => $country) {
            DB::table($tablename)->insert([
                'id' => $countryId,
                'capital' => ($country->capital ?? null),
                'citizenship' => ($country->citizenship ?? null),
                'country_code' => $country->{'country-code'},
                'currency' => ($country->currency ?? null),
                'currency_code' => ($country->currency_code ?? null),
                'currency_sub_unit' => ($country->currency_sub_unit ?? null),
                'currency_decimals' => ($country->currency_decimals ?? null),
                'full_name' => ($country->full_name ?? null),
                'iso_3166_2' => $country->iso_3166_2,
                'iso_3166_3' => $country->iso_3166_3,
                'name' => $country->name,
                'region_code' => $country->{'region-code'},
                'sub_region_code' => $country->{'sub-region-code'},
                'eea' => (bool) ($country->eea ?? false),
                'calling_code' => $country->calling_code ?? null,
                'currency_symbol' => $country->currency_symbol ?? null,
                'flag' => $country->flag ?? null,
            ]);
        }
    }
}