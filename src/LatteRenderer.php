<?php declare(strict_types=1);

namespace MartinGold\Templater;

use Nette\Bridges\ApplicationLatte\ILatteFactory;
use Pelago\Emogrifier;
use MartinGold\Templater\Exceptions\TemplateNotFoundException;

class LatteRenderer {

    /**
     * @var string
     */
    private $templatePath;

    /**
     * @var \Latte\Engine
     */
    private $latteEngine;

    public function __construct(ILatteFactory $ILatteFactory) {
        $this->latteEngine = $ILatteFactory->create();
    }

    /**
     * @throws \MartinGold\Templater\Exceptions\TemplateNotFoundException
     */
    public function render($templateName, $params): string {
        $path = $this->templatePath . $templateName . '.latte';
        if(!file_exists($path)) {
            throw new TemplateNotFoundException($path);
        }
        return $this->latteEngine->renderToString($path, $params);
    }

    /**
     * Inline external and <style> CSS to each element
     */
    public function emogrify(string $html, ?string $css): string {
        $emogrifier = new Emogrifier($html, $css);
        return $emogrifier->emogrifyBodyContent();
    }

    public function setTemplatePath(string $templatePath): void {
        $this->templatePath = Utils::path($templatePath);
    }

}
