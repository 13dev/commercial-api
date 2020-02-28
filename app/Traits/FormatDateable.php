<?php


namespace App\Traits;

use Illuminate\Support\Carbon;

trait FormatDateable
{
    protected $newDateFormat = 'd/m/Y H:i:s';

    public function getUpdatedAtAttribute($value) {
        return Carbon::parse($value)->format($this->newDateFormat);
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format($this->newDateFormat);
    }
}
