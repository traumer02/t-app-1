<?php

namespace App\Entities\Abstract;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class AbstractFilter
{

    private array $typeMap = [
        'double' => [
            'float',
        ]
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    abstract function filter(Builder $builder): Builder;

    /**
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $reflection = new \ReflectionClass(static::class);

        foreach ($filters as $key => $value) {
            $camelKey = Str::camel($key);

            try {
                $property = $reflection->getProperty($camelKey);
            } catch (\ReflectionException) {
                continue;
            }

            $type = $property->getType();
            if (
                Str::startsWith(gettype($value), $type->getName()) ||
                (
                    isset($this->typeMap[gettype($value)]) &&
                    in_array($type->getName(), $this->typeMap[gettype($value)])
                ) ||
                $value instanceof ($type->getName()) ||
                ($type->allowsNull() && is_null($value))
            ) {
                $this->{$camelKey} = $value;
            }
        }
    }
}
