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
    private CommercialRepository $commercialRepository;

    public function __construct(CommercialRepository $commercialRepository)
    {
        $this->commercialRepository = $commercialRepository;
    }

    /**
     * Get all the users.
     *
     * @param CommercialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CommercialRequest $request): JsonResponse
    {
        //$this->setParseIncludes(['photos']);

        return $this->jsonResponse($this->commercialRepository->getCommercial(1), new CommercialTransformer);
    }

}
