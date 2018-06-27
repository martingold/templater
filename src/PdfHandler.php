<?php declare(strict_types=1);

namespace MartinGold\Templater;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Nette\SmartObject;

class PdfHandler {

    use SmartObject;

    /**
     * @var string
     */
    private $pdfTemplatePath;

    /**
     * @var string
     */
    private $pdfOutputPath;

    /**
     * @var \Mpdf\Mpdf
     */
    private $mpdf;
    /**
     * @var \MartinGold\Templater\LatteRenderer
     */
    private $latteRenderer;

    /**
     * @throws \Mpdf\MpdfException
     */
    public function __construct(LatteRenderer $latteRenderer) {
        $this->mpdf = new Mpdf();
        $this->latteRenderer = $latteRenderer;
    }

    /**
     * @param mixed[] $params
     *
     * @throws \Mpdf\MpdfException
     * @throws \MartinGold\Templater\Exceptions\TemplateNotFoundException
     */
    public function savePDF(PdfParams $pdfParams, array $params): string {
        $filePath = $this->pdfOutputPath . $pdfParams->getPath();
        $html = $this->latteRenderer->render($pdfParams->getTemplateName(), $params);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($filePath, Destination::FILE);
        return $filePath;
    }

    /**
     * @param mixed[] $params
     *
     * @throws \Mpdf\MpdfException
     * @throws \MartinGold\Templater\Exceptions\TemplateNotFoundException
     */
    public function downloadPDF(PdfParams $pdfParams, array $params): void{
        $html = $this->latteRenderer->render($pdfParams->getTemplateName(), $params);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($pdfParams->getPath(), Destination::DOWNLOAD);
    }

    public function getPdfPath(PdfParams $pdfParams): string {
        return $this->pdfOutputPath . $pdfParams->getPath();
    }

    public function setPdfTemplatePath(string $pdfTemplatePath): void {
        $this->pdfTemplatePath = realpath(rtrim($pdfTemplatePath, '/')) . '/';
    }

    public function setPdfOutputPath(string $pdfOutputPath): void {
        $this->pdfOutputPath = realpath(rtrim($pdfOutputPath, '/')) . '/';
    }

}