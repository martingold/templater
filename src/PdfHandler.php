<?php declare(strict_types=1);

namespace MartinGold\Templater;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Nette\SmartObject;

class PdfHandler
{

    use SmartObject;

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

    public function __construct(LatteRenderer $latteRenderer)
    {
        $this->mpdf = new Mpdf();
        $this->latteRenderer = $latteRenderer;
    }

    /**
     * @param mixed[] $params
     */
    public function savePDF(PdfParams $pdfParams, array $params): string
    {
        $html = $this->renderToString($pdfParams, $params);
        $filePath = $this->pdfOutputPath . $pdfParams->getPath();
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($filePath, Destination::FILE);
        return $filePath;
    }

    /**
     * @param mixed[] $params
     */
    public function downloadPDF(PdfParams $pdfParams, array $params): void
    {
        $html = $this->renderToString($pdfParams, $params);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($pdfParams->getPath(), Destination::DOWNLOAD);
    }

    /**
     * @param mixed[] $params
     */
    public function renderToString(PdfParams $pdfParams, array $params): string
    {
        $params['templateName'] = basename($pdfParams->getTemplateName());
        return $this->latteRenderer->render($pdfParams->getTemplateName(), $params);
    }

    public function getPdfPath(PdfParams $pdfParams): string
    {
        return $this->pdfOutputPath . $pdfParams->getPath();
    }

    public function setPdfOutputPath(string $pdfOutputPath): void
    {
        $this->pdfOutputPath = realpath(rtrim($pdfOutputPath, '/')) . '/';
    }

}
