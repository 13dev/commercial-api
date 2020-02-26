<?php


namespace App\Serializers;

use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\SerializerAbstract;

class CustomDataSerializer extends SerializerAbstract
{
    /**
     * Serialize the top level data.
     *
     * @param array $data
     * @return array
     */
    public function serializeData($resourceKey, array $data)
    {
        return ['data' => $data];
    }

    /**
     * Serialize the included data
     *
     * @param string $resourceKey
     * @param array $data
     * @return array
     **/
    public function serializeIncludedData($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize the meta
     *
     * @param array $meta
     * @return array
     */
    public function serializeMeta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }

    /**
     * Serialize the paginator
     *
     * @param \League\Fractal\Pagination\PaginatorInterface $paginator
     * @return array
     **/
    public function serializePaginator(PaginatorInterface $paginator)
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
     * Serialize the cursor
     * @param CursorInterface $cursor
     * @return array
     */
    public function serializeCursor(CursorInterface $cursor): array
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

