<?php

namespace App\Http\Controllers;

use App\Commercial;
use App\Http\Requests\CommercialRequest;
use App\Models\User;
use App\Transformers\CommercialTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommercialController extends Controller
{

    /**
     * Get all the users.
     *
     * @param CommercialRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(CommercialRequest $request): JsonResponse
    {
        $this->setParseIncludes(['photos']);

        return $this->jsonResponse(Commercial::all(), new CommercialTransformer);
    }

}
