<?php declare(strict_types=1);

namespace MartinGold\Templater;

class PdfParams
{

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
     * @var ?string
     */
    private $headerTemplateName;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $identifier;

    public static function from(): self
    {
        return new PdfParams();
    }

    public function getPath(): string
    {
        return sprintf(
            '%s%s.%s',
            $this->filename,
            ($this->identifier !== null ? self::SEPARATOR . $this->identifier : ''),
            self::EXTENSION
        );
    }

    public function getPathWithNamespace(): string
    {
        return $this->getNamespace() . '/' . $this->getPath();
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function setTemplateName(string $templateName): self
    {
        $this->templateName = $templateName;
        return $this;
    }

    public function getTemplateName(): string
    {
        return $this->templateName;
    }

    public function getHeaderTemplateName(): ?string
    {
        return $this->headerTemplateName;
    }

    public function setHeaderTemplateName(?string $headerTemplateName): self
    {
        $this->headerTemplateName = $headerTemplateName;
        return $this;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

}
