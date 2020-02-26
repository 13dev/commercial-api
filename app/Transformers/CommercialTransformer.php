<?php

namespace App\Transformers;

use App\Commercial;
use League\Fractal\TransformerAbstract;

class CommercialTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'photos',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Commercial $user)
    {
        return [
            'id' => $user->id,
        ];
    }
}
