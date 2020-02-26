<?php

namespace App;

use App\Traits\ModelValidatable;
use App\Traits\QueryFilterable;
use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
    use ModelValidatable, QueryFilterable;

    public const TABLE = 'commercial';
    public const ID = 'id';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

    protected $table = self::TABLE;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(
            Photo::class,
            Photo::COMMERCIAL_ID,
            self::ID
        );
    }
}
