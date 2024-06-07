<?php

namespace App\Newsletter;
use App\Entity\NewsletterEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailNotification
{

    public function __construct(
        private MailerInterface $mailer,
        private string $emailAdmin
    ) {
    }

    public function sendConfirmationEmail(NewsletterEmail $newsletterEmail) : void 
    {
        $email = (new Email())
            ->from($this->emailAdmin)
            ->to($newsletterEmail->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            $this->mailer->send($email);
    }
    
}
