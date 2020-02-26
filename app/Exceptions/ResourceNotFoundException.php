<?php


namespace App\Exceptions;


use App\Helpers\Constants;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ResourceNotFoundException extends HttpException implements HttpExceptionInterface
{
    public function __construct(\Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        parent::__construct(Response::HTTP_NOT_FOUND,  trans(Constants::RESOURCE_NOT_FOUND_MESSAGE), $previous, $headers, $code);
    }
}
