<?php declare(strict_types=1);

namespace MartinGold\Templater;

use Nette\Mail\IMailer;
use Nette\Mail\Message;
use Nette\SmartObject;

class TemplateMailer {

    use SmartObject;

    /**
     * @var string
     */
    private $mailTemplatePath;

    /**
     * @var \Nette\Mail\IMailer
     */
    private $mailer;

    /**
     * @var string|null
     */
    private $css;
    /**
     * @var \MartinGold\Templater\LatteRenderer
     */
    private $latteRenderer;

    public function __construct(IMailer $mailer, LatteRenderer $latteRenderer) {
        $this->mailer = $mailer;
        $this->latteRenderer = $latteRenderer;
    }

    /**
     * @throws \MartinGold\Templater\Exceptions\TemplateNotFoundException
     */
    public function send(Message $message, string $templateName, array $params): string {
        $html = $this->renderMessage($templateName, $params);
        $message->setHtmlBody($html);
        $this->mailer->send($message);
        return $html;
    }

    public function renderMessage(string $templateName, array $params): string {
        $html = $this->latteRenderer->render($templateName, $params);
        return $this->latteRenderer->emogrify($html, $this->css);
    }

    public function setMailTemplatePath(string $mailTemplatePath): void{
        $this->mailTemplatePath = Utils::path($mailTemplatePath);
    }

    public function setCssPath(?string $cssPath): void{
        if($cssPath !== null) {
            $this->css = $this->getCss(Utils::path($cssPath));
        }
    }

    private function getCss(string $cssPath): ?string {
        return file_exists($cssPath) && is_file($cssPath) ? file_get_contents($cssPath) : '';
    }

}
