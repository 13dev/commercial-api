<?php


namespace App\Repositories;


use App\Commercial;
use App\Exceptions\EmptyResultsException;
use App\Exceptions\ResourceNotFoundException;
use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

class CommercialRepository extends BaseRepository implements RepositoryInterface
{
    public function model()
    {
        return Commercial::class;
    }


    /**
     * @param null $sortBy
     * @param string $order
     * @param int $limit
     * @return mixed
     */
    public function getCommercials($sortBy = 'created_at', $order = 'asc', int $limit = 10)
    {
        $collection = $this
            ->scopeQuery(fn($q) => $q->orderBy($sortBy, $order))
            ->paginate($limit);

       if($collection->isEmpty()) {
           throw new EmptyResultsException(Constants::RESOURCE_ADS);
       }

       return $collection;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ResourceNotFoundException
     */
    public function getCommercial(int $id)
    {
        $resource = $this->findWhere([Commercial::ID => $id]);

        if($resource->isEmpty()) {
            throw new ResourceNotFoundException;
        }

        return $resource;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ValidatorException
     */
    public function createCommercial(array $data)
    {
        /** @var Commercial $commercial */
        $commercial = $this->create($data);

        $photos = [];
        foreach ($data['photos'] ?? [] as $photo) {
            $photos[] = ['content' => $photo];
        }

        //create Photos
        $commercial->photosRelation()->createMany($photos);

        return $commercial;
    }
}
