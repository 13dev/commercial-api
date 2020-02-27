<?php


namespace App\Transformers;


use App\Photo;
use League\Fractal\TransformerAbstract;

class PhotoTransformer extends TransformerAbstract
{

    public function transform(Photo $photo)
    {
        return [
            'photo_id' => $photo->getKey(),
            'content' => $photo->getAttribute(Photo::CONTENT),
        ];
    }

}
