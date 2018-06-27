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
     * @var string
     */
    private $cssPath = '';
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
    public function send(Message $message, string $templateName, array $params): void {
        $html = $this->latteRenderer->render($templateName, $params);
        $html = $this->latteRenderer->emogrify($html, $this->cssPath);
        $message->setHtmlBody($html);
        $this->mailer->send($message);
    }

    public function setMailTemplatePath(string $mailTemplatePath): void{
        $this->mailTemplatePath = Utils::path($mailTemplatePath);
    }

    public function setCssPath(?string $cssPath): void{
            $this->cssPath = Utils::path($cssPath);
    }

}
