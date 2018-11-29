<?php declare(strict_types=1);

namespace MartinGold\Templater\Helper\Spec;

use Kahlan\Plugin\Double;
use Latte\Engine;
use MartinGold\Templater\Helper\Exceptions\TemplateNotFoundException;
use MartinGold\Templater\Helper\LatteRenderer;

function getLatteRenderer(): LatteRenderer {
    /** @var \Nette\Bridges\ApplicationLatte\ILatteFactory $ILatteFactory */
    $ILatteFactory = Double::instance([
        'implements' => '\Nette\Bridges\ApplicationLatte\ILatteFactory',
    ]);
    allow($ILatteFactory)->toReceive('create')->andReturn(new Engine());
    return new LatteRenderer($ILatteFactory);
}

describe('LatteRenderer', function () {

    describe('->emogrify', function () {
        it('should inline external css to html', function () {
            $assetPath = __DIR__ . '/assets/emogrify/';
            $css = file_get_contents($assetPath . 'css.css');
            $before = file_get_contents($assetPath . 'before.html');
            $after = file_get_contents($assetPath . 'after.html');
            $result = getLatteRenderer()->emogrify($before, $css);
            expect($result)->toBe($after);
       });
    });

    describe('->render', function () {

        it('should throw TemplateNotFoundException when file does not exist', function () {
            $path = 'dir/template.latte';
            expect(function() {
                getLatteRenderer()->render('dir/file.latte', []);
            })->toThrow(new TemplateNotFoundException($path));
        });

        it('should render latte from file', function() {
            allow('file_get_contents')->toBeCalled()->andReturn('Hello {$name}!');
            allow('file_exists')->toBeCalled()->andReturn(true);
            allow('is_file')->toBeCalled()->andReturn(true);
            $html = getLatteRenderer()->render('template.file', [
                'name' => 'Bob',
            ]);
            expect($html)->toBe('Hello Bob!');
        });

    });
});
