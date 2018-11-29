<?php declare(strict_types=1);

namespace MartinGold\Templater\Exception;

class TemplateNotFoundException extends \Nette\FileNotFoundException
{

    public function __construct(string $message, int $code = 0, ?\Throwable $previous = null)
    {
        $pathMessage = sprintf('Template %s not found in %s', basename($message), dirname($message));
        parent::__construct($pathMessage, $code, $previous);
    }

}
