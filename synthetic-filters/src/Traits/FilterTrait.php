<?php

namespace SyntheticFilters\Traits;

use Abbasudo\Purity\Traits\Filterable as PurityFilterTrait;
use Abbasudo\Purity\Traits\Sortable as PuritySortTrait;
use Illuminate\Support\Str;
use SyntheticFilters\Models\CustomCollection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\URL;

trait FilterTrait
{
    use AttributeType;
    use PurityFilterTrait;
    use PuritySortTrait;

    protected $resource;
    // protected $filterFields;
    public function filterData()
    {
        $className = get_class($this);
        $reflection = new \ReflectionClass($className); // Replicated class
        $property = $reflection->getProperty('fillableAttributes');
        $property->setAccessible(true);
        $filterAttribute = $property->getValue($this);

        $data = [];
        foreach ($filterAttribute as $key => $value) {

            $data[$key] = [
                'label' => $value['label'] ?? '',
                'type' => $value['type'],
            ];

            if (!empty($value['model'])) {
                $data[$key]['optionsApi'] = $value['endpoint'];
                $data[$key]['searchColumn'] = $value['relation_key'];


                $data[$key]['isMultiSelect'] = $value['isMultiSelect'] ?? true;
            }

            if (isset($value['optionData'])) {
                $data[$key]['optionsData'] = $value['optionData'];
            }
        }
        return $data;
    }

    /**
     * adding toFlatArray() into custom collection 
     */
    public function newCollection(array $models = [])
    {
        return new CustomCollection($models);
    }
}
