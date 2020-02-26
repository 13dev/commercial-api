<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public const TABLE = 'photo';
    public const ID = 'id';
    public const COMMERCIAL_ID = 'commercial_id';
    public const CONTENT = 'content';

    protected $table = self::TABLE;

    public function commercial()
    {
        return $this->hasOne(Commercial::class, Commercial::ID, self::COMMERCIAL_ID);
    }
}
