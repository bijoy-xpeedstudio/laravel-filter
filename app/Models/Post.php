<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use SyntheticFilters\Traits\FilterTrait;
use SyntheticRevisions\Trait\RevisionableTrait;

class Post extends Model
{
    use FilterTrait, HasFactory, RevisionableTrait;
    protected $fillable = ['name', 'job_title', 'line_manager', 'department', 'Office', 'employee_status', 'account'];
    public static $print;

    public $fillableAttributes = [
        'name' => [
            'type' => self::TEXT,
            'label' => 'Name',
            'validation' => [
                "default" => "required",
                "update" => ""
            ],
        ],
        'job_title' => [
            'type' => self::TEXT,
            'label' => 'Job Title',
        ],
        'line_manager' => [
            'type' => self::TEXT,
            'label' => 'Line Manager',
        ],
        'department_id' => [
            'type' => self::SELECT,
            'label' => 'Department',
            //relation
            'relation' => 'user',
            'model' => self::class, //change for filter
            'relation_key' => '_id', //chage for filter
            'isMultiSelect' => true,
            'endpoint' => 'filter/list/module/app/models/department'
        ],
        'Office' => [
            'type' => self::CHECKBOX,
            'label' => 'Office',
            //relation
            'model' => Category::class, // if model set then endpoint paramater append from filter package
            'relation_key' => '_id',
            'isMultiSelect' => true, // for select and checkbox
            'validation' => [
                "default" => "required",   //by default set default if update then update
                "update" => ""
            ],
            'endpoint' => 'filter/list/module/app/models/flag'
        ],
        'employee_status' => [
            'type' => self::TEXT,
            'label' => 'Employee Status'
        ],
        'account' => [
            'type' => self::SELECT,
            'label' => 'Account',
            'optionData' => [
                'active' => 'Active',
                'deactive' => 'Deactive'
            ]
        ],
        'created_at' => [
            'type' => 'datepicker',
            'label' => 'Created at'
        ]
    ];

    protected $sortFields = [
        'name', 'job_title', 'line_manager', 'department', 'Office', 'employee_status', 'account'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Develop for make flat array from relation object
     * Ex. category_name: 'fooo'
     */
    protected function getValidRelations()
    {
        return [
            'department_id' => [
                'relationWith' => 'department',
                'relationColumn' => [
                    'name',
                ],
            ],
        ];
    }
}
