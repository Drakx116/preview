<?php

namespace App\Services;

use App\Entity\NewsletterUser;
use Swift_Mailer as SwiftMailer;
use Swift_Message as Email;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Mailer
{
    /**
     * @var SwiftMailer
     */
    private $swiftMailer;
    /**
     * @var Environment
     */
    private $twigEngine;

    /**
     * Mailer constructor.
     * @param SwiftMailer $swiftMailer
     * @param Environment  $twigEngine
     */
    public function __construct(SwiftMailer $swiftMailer, Environment $twigEngine)
    {
        $this->swiftMailer = $swiftMailer;
        $this->twigEngine = $twigEngine;
    }

    /**
     * @param NewsletterUser $user
     * @return int
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendNewsletterRegistrationEmail(NewsletterUser $user): int
    {
        return $this->swiftMailer->send((new Email())
            ->setSubject('Preview Newsletter - Welcome')
            ->setFrom('sendmail@preview.lan')
            ->setTo($user->getEmail())
            ->setBody($this->twigEngine->render('emails/registration.twig'))
            ->setContentType('text/html')
        );
    }
}
