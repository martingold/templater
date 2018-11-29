<?php declare(strict_types=1);

namespace MartinGold\Templater\Helper;

class CssHelper
{

    public static function getCss(?string $path): string
    {
        if ($path === null) {
            return '';
        }

        if (!file_exists($path) || !is_file($path)) {
            return '';
        }

        $css = file_get_contents($path);
        return $css === false ? '' : $css;
    }

}
