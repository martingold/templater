<?php declare(strict_types=1);

namespace MartinGold\Templater\Spec;

use MartinGold\Templater\Utils;

describe('Utils class', function () {

    describe('::path', function () {
        it('ensures slash at end of path', function () {
            $expected = 'test/path/';
            $actual = Utils::path('test/path');
            expect($actual)->toBe($expected);
        });
    });

});
