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
        $resources = $this->repository->getCommercial(4);

        //include photos on response.
        $this->setParseIncludes(['photos', 'main_photo']);

        return $this->jsonResponse($resources, new CommercialTransformer);
    }

}
