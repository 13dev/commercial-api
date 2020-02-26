<?php


namespace App\Repositories;


use App\Commercial;
use App\Exceptions\EmptyResultsException;
use App\Exceptions\ResourceNotFoundException;
use App\Helpers\Constants;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class CommercialRepository extends BaseRepository implements RepositoryInterface
{
    public function model()
    {
        return Commercial::class;
    }

    /**
     * @return mixed
     * @throws EmptyResultsException
     */
    public function getCommercials()
    {
       $collection = $this->all();

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
}
