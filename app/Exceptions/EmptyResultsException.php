<?php


namespace App\Exceptions;


use App\Helpers\Constants;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class EmptyResultsException extends HttpException implements HttpExceptionInterface
{
    public function __construct(string $resource, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct(Response::HTTP_NO_CONTENT, trans(Constants::NO_RESULTS_MESSAGE, ['resource' => $resource]), $previous, $headers, $code);
    }
}
