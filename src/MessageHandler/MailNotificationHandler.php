<?php
 
namespace App\MessageHandler;
 
use App\Message\MailNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Mime\Email;
 
class MailNotificationHandler implements MessageHandlerInterface
{
 
    public function __construct(private MailerInterface $mailer)
    {}
 
    public function __invoke(MailNotification $message)
    {
        $email = (new Email())
        ->from($message->getFrom())
        ->to('admin@my-incidents.io')
        ->subject('New Incident #' . $message->getId() . ' - ' . $message->getFrom())
        ->html('<p>' . $message->getDescription() . '</p>');
 
        sleep(10);
 
        $this->mailer->send($email);
    }
}
