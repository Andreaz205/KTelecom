<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class EquipmentFilter extends AbstractFilter
{
    public const DESC           = 'desc';
    public const SERIAL_NUMBER  = 'serial_number' ;

    protected function getCallbacks(): array
    {
        return [
            self::DESC            =>    [ $this, 'desc'          ],
            self::SERIAL_NUMBER   =>    [ $this, 'serial_number' ],
        ];
    }

    public function desc(Builder $builder, $value)
    {
        $builder->where('desc', 'ilike', '%'.$value.'%');
    }

    public function serial_number(Builder $builder, $value)
    {
        $builder->where('serial_number', 'ilike', '%'.$value.'%');
    }
}
