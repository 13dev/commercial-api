<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Helpers\Helpers;
use App\Http\Requests\CommercialPostRequest;
use App\Http\Requests\CommercialsRequest;
use App\Models\User;
use App\Repositories\CommercialRepository;
use App\Transformers\CommercialTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
     * @param CommercialsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CommercialsRequest $request): JsonResponse
    {
        $resources = $this->repository->getCommercials(
            $request->get('sortBy', 'created_at'),
            $request->get('order', 'asc'),
            $request->get('limit', 10)
        );

        return $this->jsonResponsePaginate($resources, new CommercialTransformer);
    }


    public function show(int $id, Request $request): JsonResponse
    {
        $includes = Helpers::parseIncludes(
            $request->get('includes', ''),
            ['photos', 'description']
        );

        $this->setParseIncludes($includes);

        $resource = $this->repository->getCommercial($id);

        return $this->jsonResponse($resource, new CommercialTransformer);
    }

    public function create(CommercialPostRequest $request): JsonResponse
    {
        $resource = $this->repository->createCommercial($request->all());

        return $this->jsonResponse($resource, new CommercialTransformer);
    }

}
