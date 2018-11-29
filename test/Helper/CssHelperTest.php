<?php declare(strict_types=1);

namespace MartinGold\Templater\Test\Helper;


use MartinGold\Templater\Helper\CssHelper;

class CssHelperTest extends \Codeception\Test\Unit
{

    public function testGetCssValid(): void
    {
        $path = __DIR__ . '/../_asset/style.css';
        $this->assertNotEmpty(CssHelper::getCss($path));
    }

    public function testGetCssInvalid(): void
    {
        $path = __DIR__ . '/style.css';
        $this->assertEmpty(CssHelper::getCss($path));
    }

}
