<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Model as Model;

class Service extends Model
{
    use HasRecordOwnerProperties;

    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var string[]
     */
    protected $fillable = [
        'service_id',
        'service_name',
        'service_desc',
        'is_active',
        'created_at',
        'updated_at',
        'added_by',
        'updated_by',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'service_id' => 'string',
        'service_name' => 'string',
        'service_desc' => 'string',
        'is_active' => 'boolean',
        'added_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
