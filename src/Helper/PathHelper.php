<?php declare(strict_types=1);

namespace MartinGold\Templater\Helper;

abstract class PathHelper
{

    /**
     * Ensure given path has trailing slash at the end
     */
    public static function path(string $path): string
    {
        return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

}
