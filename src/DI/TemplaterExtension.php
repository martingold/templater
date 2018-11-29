<?php declare(strict_types=1);

namespace MartinGold\Templater\DI;

class TemplaterExtension extends \Nette\DI\CompilerExtension
{

    private const BASE_DIR = __DIR__ . '/../../../../../';

    /**
     * @var mixed[]
     */
    private $defaults = [
        'templatePath' => self::BASE_DIR . 'app/template/',
        'cssPath' => null,
        'pdfOutputPath' => self::BASE_DIR . 'www/downloads/pdf/',
    ];

    /**
     * @return void
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingReturnTypeHint
     */
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();

        $this->validateConfig($this->defaults);

        $builder->addDefinition($this->prefix('templateMailer'))
            ->setFactory('MartinGold\Templater\TemplateMailer')
            ->addSetup('setCssPath', [self::BASE_DIR . $this->config['cssPath']]);

        $builder->addDefinition($this->prefix('pdf'))
            ->setFactory('MartinGold\Templater\PdfHandler')
            ->addSetup('setPdfOutputPath', [self::BASE_DIR . $this->config['pdfOutputPath']])
            ->addSetup('setCssPath', [self::BASE_DIR . $this->config['cssPath']]);

        $builder->addDefinition($this->prefix('latteRenderer'))
            ->setFactory('MartinGold\Templater\LatteRenderer')
            ->addSetup('setTemplatePath', [self::BASE_DIR . $this->config['templatePath']]);
    }

}
