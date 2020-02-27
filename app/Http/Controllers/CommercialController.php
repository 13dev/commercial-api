<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Http\Requests\CommercialRequest;
use App\Models\User;
use App\Repositories\CommercialRepository;
use App\Transformers\CommercialTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommercialController extends Controller
{
    /**
     * @var CommercialRepository
     */
    private CommercialRepository $repository;

    /**
     * CommercialController constructor.
     * @param CommercialRepository $commercialRepository
     */
    public function __construct(CommercialRepository $commercialRepository)
    {
        $this->repository = $commercialRepository;
    }

    /**
     * Get all the users.
     *
     * @param CommercialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CommercialRequest $request): JsonResponse
    {
        $resources = $this->repository->getCommercials(
            $request->get('sortBy', 'created_at'),
            $request->get('order', 'asc'),
            $request->get('limit', 10)
        );

        //includes on response.
        $this->setParseIncludes(['main_photo', 'photos']);

        return $this->jsonResponsePaginate($resources, new CommercialTransformer);
    }

}
