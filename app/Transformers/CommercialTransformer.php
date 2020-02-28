<?php

namespace App\Transformers;

use App\Commercial;
use App\Photo;
use League\Fractal\TransformerAbstract;

class CommercialTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'main_photo'
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'photos',
        'description',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Commercial $commercial)
    {
        return [
            //'ads_id' => $commercial->getKey(),
            'title' => $commercial->getAttribute(Commercial::TITLE),
            //'createdAt' => $commercial->getAttribute(Commercial::CREATED_AT),
            'price' => $commercial->getAttribute(Commercial::PRICE),
        ];
    }

    /**
     * Relationship with photos.
     * @param Commercial $commercial
     * @return \League\Fractal\Resource\Collection
     */
    public function includePhotos(Commercial $commercial)
    {
        $photos = $commercial->photos();

        return $this->collection($photos ?? null, new PhotoTransformer);

    }

    /**
     * Description is optional
     * @param Commercial $commercial
     * @return \League\Fractal\Resource\Primitive
     */
    public function includeDescription(Commercial $commercial)
    {
        return $this->primitive($commercial, function (Commercial $commercial) {
            return $commercial->getAttribute(Commercial::DESCRIPTION) ?? '';
        });
    }

    public function includeMainPhoto(Commercial $commercial)
    {
        $mainPhoto = optional($commercial->mainPhoto());

        return $this->primitive(
            $commercial,
            fn () => $mainPhoto->getAttribute(Photo::CONTENT)
        );
    }

}
