<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use SyntheticFilters\Traits\FilterTrait;

class Flag extends Model
{
    use HasFactory, FilterTrait;
    public $fillableAttributes = [
        '_id' => [
            'type' => self::TEXT,
            'lable' => 'id'
        ],
        'name' => [
            'type' => self::TEXT,
            'label' => 'Name',
            'validation' => [
                "default" => "required",
                "update" => ""
            ]
        ],
        // 'status' => [
        //     'type' => self::TEXT,
        //     'label' => 'Job Title',
        // ]
    ];
}
