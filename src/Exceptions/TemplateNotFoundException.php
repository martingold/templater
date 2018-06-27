<?php declare(strict_types=1);

namespace MartinGold\Templater\Exceptions;

use Nette\FileNotFoundException;

class TemplateNotFoundException extends FileNotFoundException {

    private $path;

    public function __construct(string $path) {
        parent::__construct();
        $this->path = $path;
    }

    public function __toString() {
        return sprintf('Template %s not found in %s', basename($this->path), $this->path);
    }

}