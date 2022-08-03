<?php

namespace App\Domains\Ref\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Country extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('ref');
    }

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'capital', 'citizenship', 'country_code', 'currency', 'currency_code', 'currency_sub_unit', 'currency_symbol',
        'full_name', 'iso_3166_2', 'iso_3166_3', 'name', 'region_code', 'sub_region_code', 'eea', 'calling_code',
        'flag',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $schema = config('ref.schema');

        if (! empty($schema)) {
            switch (DB::getDriverName()) {
                case 'mysql': case 'pgsql': case 'sqlsrv':
                $schema = $schema.'.';
                break;
            }
        }
        $this->table = $schema.config('ref.tables.countries');
    }

//    public function organisations()
//    {
//        return $this->belongsToMany(Organisation::class, 'ref.organisation_countries', 'country_id', 'organisation_id');
//    }
//
//    public function currency()
//    {
//        return $this->belongsTo(Currency::class, 'currency_code', 'code');
//    }
}