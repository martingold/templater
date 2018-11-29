<?php declare(strict_types=1);

namespace MartinGold\Templater;

use Nette\Mail\IMailer;
use Nette\Mail\Message;
use Nette\SmartObject;

class TemplateMailer
{

    use SmartObject;

    /**
     * @var \Nette\Mail\IMailer
     */
    private $mailer;

    /**
     * @var \MartinGold\Templater\LatteRenderer
     */
    private $latteRenderer;

    public function __construct(IMailer $mailer, LatteRenderer $latteRenderer)
    {
        $this->mailer = $mailer;
        $this->latteRenderer = $latteRenderer;
    }

    /**
     * @param mixed[] $params
     */
    public function send(Message $message, string $templateName, array $params): string
    {
        $html = $this->renderMessage($templateName, $params);
        $message->setHtmlBody($html);
        $this->mailer->send($message);
        return $html;
    }

    /**
     * @param mixed[] $params
     * @return string
     */
    public function renderMessage(string $templateName, array $params): string
    {
        return $this->latteRenderer->render($templateName, $params);
    }

}
