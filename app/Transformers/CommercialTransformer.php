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
        'main_photo',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Commercial $commercial)
    {
        return [
            'ads_id' => $commercial->getKey(),
            'title' => $commercial->getAttribute(Commercial::TITLE),
        ];
    }

    /**
     * Relationship with photos.
     * @param Commercial $commercial
     * @return \League\Fractal\Resource\Collection
     */
    public function includePhotos(Commercial $commercial)
    {
        return $this->collection($commercial->photos() ?: [], new PhotoTransformer);
    }

    /**
     * Description is optional
     * @param Commercial $commercial
     * @return \League\Fractal\Resource\Item
     */
    public function includeDescription(Commercial $commercial)
    {
        return $this->item($commercial, [
            'description' => $commercial->getAttribute(Commercial::DESCRIPTION) ?? ''
        ]);
    }


    public function includeMainPhoto(Commercial $commercial)
    {
        return $this->item($commercial->mainPhoto(), new PhotoTransformer);
    }

}
