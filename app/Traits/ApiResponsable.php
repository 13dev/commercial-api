<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\SerializerAbstract;
use League\Fractal\TransformerAbstract;

trait ApiResponsable
{
    protected array $parseIncludes = [];

    /**
     * @param $data
     * @param TransformerAbstract $transformer
     * @param int $status
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    protected function jsonResponse($data, TransformerAbstract $transformer, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        $data = fractal($data, $transformer)
            ->parseIncludes($this->parseIncludes)
            ->paginateWith(new IlluminatePaginatorAdapter($data))
            ->toArray();

        return new JsonResponse($data, $status, $headers, $options);
    }

    protected function jsonResponsePaginate(LengthAwarePaginator $lengthAwarePaginator, TransformerAbstract $transformer, $status = 200, array $headers = [], $options = 0): JsonResponse
    {
        $dataCollection = $lengthAwarePaginator->getCollection();

        $data = fractal($dataCollection, $transformer)
            ->parseIncludes($this->parseIncludes)
            ->paginateWith(new IlluminatePaginatorAdapter($lengthAwarePaginator))
            ->toArray();

        return new JsonResponse($data, $status, $headers, $options);
    }

    /**
     * @param $data
     * @param TransformerAbstract $transformer
     * @param int $status
     * @param array $headers
     * @param int $options
     */
    protected function throwException($data, TransformerAbstract $transformer, $status = 200, array $headers = [], $options = 0)
    {
        $data = fractal($data, new $transformer())
            ->parseIncludes($this->parseIncludes)
            ->toArray();

        $response = new JsonResponse($data, $status, $headers, $options);
        $response->throwResponse();
    }

    /**
     * @param array $parseIncludes
     * @return ApiResponsable
     */
    protected function setParseIncludes(array $parseIncludes)
    {
        $this->parseIncludes = $parseIncludes;
        return $this;
    }
}
