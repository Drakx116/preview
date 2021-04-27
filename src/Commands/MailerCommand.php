<?php

namespace App\Commands;

use App\Repository\NewsletterUserRepository;
use App\Services\Utils\Mailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class MailerCommand
 * @package App\Commands
 */
class MailerCommand extends Command
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var NewsletterUserRepository
     */
    private $newsletterUserRepository;

    /**
     * MailerCommand constructor.
     * @param Mailer                   $mailer
     * @param NewsletterUserRepository $newsletterUserRepository
     */
    public function __construct(Mailer $mailer, NewsletterUserRepository $newsletterUserRepository)
    {
        parent::__construct();

        $this->mailer = $mailer;
        $this->newsletterUserRepository = $newsletterUserRepository;
    }

    /**
     * @var string
     */
    protected static $defaultName = 'app:newsletter:send';

    /**
     * @return void
     */
    public function configure(): void
    {
        $this
            ->setDescription('Sends the Newsletter')
            ->setHelp('This command allows you to send a email to every active newsletter user.');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->newsletterUserRepository->findBy([ 'isActive' => true ]);

        $sent = 0;
        foreach ($users as $user) {
            $sent +=  $this->mailer->sendDailyNewsletter($user);
        }

        return $sent;
    }
}
