<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use SyntheticFilters\Traits\FilterTrait;


class Category extends Model
{
    use HasFactory, FilterTrait;

    protected $fillable = ['name', 'job_title', 'line_manager', 'department', 'Office', 'employee_status', 'account'];
    public static $print;

    public $fillableAttributes = [
        'name' => [
            'type' => self::TEXT,
            'label' => 'Name',
            'validation' => [
                "default" => "required",
                "update" => ""
            ]
        ],
        'job_title' => [
            'type' => self::TEXT,
            'label' => 'Job Title',
        ],
        'line_manager' => [
            'type' => self::TEXT,
            'label' => 'Line Manager',
        ],
        'department' => [
            'type' => self::TEXT,
            'label' => 'Department',
            //relation
            'relation' => 'user',
        ],
        'Office' => [
            'type' => self::SELECT,
            'label' => 'Office',
            'model' => Category::class, // if model set then endpoint paramater append from filter package
            'relation_key' => '_id',
            'isMultiSelect' => false, // for select and checkbox
            'validation' => [
                "default" => "required",   //by default set default if update then update
                "update" => ""
            ]
        ],
        'employee_status' => [
            'type' => self::TEXT,
            'label' => 'Employee Status'
        ],
        'account' => [
            'type' => self::TEXT,
            'label' => 'Account'
        ],
    ];

    protected $sortFields = [
        'name', 'job_title', 'line_manager', 'department', 'Office', 'employee_status', 'account'
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
