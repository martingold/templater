<?php declare(strict_types=1);

namespace MartinGold\Templater\Helper\Spec;

use MartinGold\Templater\Helper\PathHelper;

describe('Utils class', function () {

    describe('::path', function () {
        it('ensures slash at end of path', function () {
            $expected = 'test/path/';
            $actual = PathHelper::path('test/path');
            expect($actual)->toBe($expected);
        });
    });

});
