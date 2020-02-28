<?php


namespace App\Helpers;


class Helpers
{
    public static function parseIncludes(string $includes, array $permittedIncludes): array
    {
        $includes = explode(',', $includes);

        // remove blank includes.
        $includes = array_filter($includes, 'strlen');

        return array_unique(array_intersect($includes, $permittedIncludes));
    }
}
