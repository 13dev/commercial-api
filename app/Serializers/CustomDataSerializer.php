<?php


namespace App\Serializers;

use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;

class CustomDataSerializer extends SerializerAbstract
{
    /**
     * @inheritDoc
     */
    public function collection($resourceKey, array $data)
    {
        return [$resourceKey?: 'data' => $data];
    }

    /**
     * @inheritDoc
     */
    public function item($resourceKey, array $data)
    {
        if ($resourceKey) {
            return [$resourceKey => $data];
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function null()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function includedData(ResourceInterface $resource, array $data)
    {
        return $data;
    }

    /**
     * @inheritDoc
     */
    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }

    /**
     * @inheritDoc
     */
    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int) $paginator->getCurrentPage();
        $lastPage = (int) $paginator->getLastPage();

        $pagination = [
            'total' => (int) $paginator->getTotal(),
            'count' => (int) $paginator->getCount(),
            'per_page' => (int) $paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages' => $lastPage,
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }

        return ['pagination' => $pagination];
    }

    /**
     * @inheritDoc
     */
    public function cursor(CursorInterface $cursor)
    {
        return [
            'cursor' => [
                'current' => $cursor->getCurrent(),
                'prev' => $cursor->getPrev(),
                'next' => $cursor->getNext(),
                'count' => (int)$cursor->getCount(),
            ]
        ];
    }
}

