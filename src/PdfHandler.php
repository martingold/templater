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
        $html = $this->renderToString($pdfParams->getTemplateName(), $params);
        $this->mpdf->WriteHTML($html);

        if ($pdfParams->getHeaderTemplateName() !== null) {
            $header = $this->renderToString($pdfParams->getHeaderTemplateName(), $params);
            $this->mpdf->SetHTMLHeader($header);
        }

        $filePath = $this->pdfOutputPath . $pdfParams->getPath();
        $this->mpdf->Output($filePath, Destination::FILE);
        return $filePath;
    }

    /**
     * @param mixed[] $params
     */
    public function downloadPDF(PdfParams $pdfParams, array $params): void
    {
        $html = $this->renderToString($pdfParams->getTemplateName(), $params);
        $this->mpdf->showImageErrors = true;

        if ($pdfParams->getHeaderTemplateName() !== null) {
            $header = $this->renderToString($pdfParams->getHeaderTemplateName(), $params);
            $this->mpdf->SetHTMLHeader($header);
        }

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output($pdfParams->getPath(), Destination::DOWNLOAD);
    }

    /**
     * @param mixed[] $params
     */
    public function renderToString(string $templateName, array $params): string
    {
        $params['templateName'] = basename($templateName);
        return $this->latteRenderer->render($templateName, $params);
    }

    public function getPdfPath(PdfParams $pdfParams): string
    {
        return $this->pdfOutputPath . $pdfParams->getPath();
    }

    public function setPdfOutputPath(string $pdfOutputPath): void
    {
        $this->pdfOutputPath = realpath(rtrim($pdfOutputPath, '/')) . '/';
    }

    public function getMpdf(): Mpdf
    {
        return $this->mpdf;
    }

}
