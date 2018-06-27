<?php declare(strict_types=1);

namespace MartinGold\Templater;

abstract class Utils {

    /**
     * Ensure given path has trailing slash at the end
     */
    public static function path(string $path) {
        return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

}