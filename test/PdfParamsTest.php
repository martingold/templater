<?php declare(strict_types=1);

namespace MartinGold\Templater\Test;

use MartinGold\Templater\PdfParams;

class PdfParamsTest extends \Codeception\Test\Unit
{

    private function getPdfParams(): PdfParams
    {
        return PdfParams::from()
            ->setTemplateName('template')
            ->setNamespace('report')
            ->setFilename('report')
            ->setIdentifier('1001');
    }


    public function testPdfParamsPath(): void
    {
        $expected = 'report/report-1001.pdf';
        $this->assertEquals($expected, $this->getPdfParams()->getPathWithNamespace());
    }

}
