<?php declare(strict_types=1);

namespace MartinGold\Templater\Helper\Spec\Exceptions;

use MartinGold\Templater\Helper\Exceptions\TemplateNotFoundException;

describe('TemplateNotFoundException', function() {

    it('should format exception message', function () {
       $exception = new TemplateNotFoundException('../directory/templateFile.latte');
       expect($exception->__toString())->toBe('Template templateFile.latte not found in ../directory');
    });

});