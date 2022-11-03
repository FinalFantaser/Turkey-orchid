<?php

namespace App\Casts\Lead;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DateTime implements CastsAttributes
{
    private const TIMEZONE = 'Europe/Moscow';
    private const FORMAT = 'd.m.Y, H:i:s';

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return Carbon::parse($value, 'UTC')->timezone(self::TIMEZONE)->format(self::FORMAT);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return Carbon::parse($value, 'UTC')->getTimestamp();
    }
}
