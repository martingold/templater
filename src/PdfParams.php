<?php declare(strict_types=1);

namespace MartinGold\Templater;

class PdfParams {

    public const EXTENSION = 'pdf';
    public const SEPARATOR = '-';

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $templateName;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $identifier;

    public function getPath(): string {
        return $this->filename .
               ($this->identifier !== null ? self::SEPARATOR . $this->identifier : '')
               . '.' . self::EXTENSION;
    }

    public function getPathWithNamespace() {
        return $this->getNamespace() . '/' . $this->getPath();
    }

    /**
     * @param mixed[] $params
     */
    public static function from(): self {
        return new PdfParams();
    }

    public function getFilename(): string {
        return $this->filename;
    }

    public function setFilename(string $filename): PdfParams{
        $this->filename = $filename;
        return $this;
    }

    public function getNamespace(): string {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): PdfParams {
        $this->namespace = $namespace;
        return $this;
    }

    public function setTemplateName(string $templateName): PdfParams {
        $this->templateName = $templateName;
        return $this;
    }

    public function getTemplateName(): string {
        return $this->templateName;
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): PdfParams {
        $this->identifier = $identifier;
        return $this;
    }

}
