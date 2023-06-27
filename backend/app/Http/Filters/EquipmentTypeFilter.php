<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentTypeFilter extends AbstractFilter
{
    public const NAME  = 'name';
    public const MASK  = 'mask' ;

    protected function getCallbacks(): array
    {
        return [
            self::NAME   =>    [ $this, 'name' ],
            self::MASK   =>    [ $this, 'mask' ],
        ];
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'ilike', '%'.$value.'%');
    }

    public function mask(Builder $builder, $value)
    {
        $builder->where('mask', 'ilike', '%'.$value.'%');
    }
}
