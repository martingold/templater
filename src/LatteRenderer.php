<?php declare(strict_types=1);

namespace MartinGold\Templater;

use MartinGold\Templater\Helper\CssHelper;
use MartinGold\Templater\Helper\PathHelper;
use Nette\Bridges\ApplicationLatte\ILatteFactory;
use Pelago\Emogrifier;

class LatteRenderer
{

    /**
     * @var string
     */
    private $templatePath;

    /**
     * @var \Latte\Engine
     */
    private $latteEngine;

    /**
     * @var string
     */
    private $css;

    public function __construct(ILatteFactory $ILatteFactory)
    {
        $this->latteEngine = $ILatteFactory->create();
    }

    /**
     * @param mixed[] $params
     */
    public function render(string $templateName, array $params): string
    {
        $path = $this->templatePath . $templateName . '.latte';
        if (!file_exists($path)) {
            throw new \MartinGold\Templater\Exception\TemplateNotFoundException($path);
        }
        $html = $this->latteEngine->renderToString($path, $params);
        return $this->emogrify($html);
    }

    /**
     * Inline external and <style> CSS to each element
     */
    public function emogrify(string $html): string
    {
        $emogrifier = new Emogrifier($html, $this->css);
        return $emogrifier->emogrify();
    }

    public function setTemplatePath(string $templatePath): void
    {
        $this->templatePath = PathHelper::path($templatePath);
    }

    public function setCssPath(?string $cssPath): void
    {
        $this->css = CssHelper::getCss($cssPath);
    }

}
