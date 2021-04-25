<?php

namespace App\Controller;

use App\Entity\NewsletterUser;
use App\Form\NewsletterType;
use App\Services\Utils\Mailer;
use App\Services\Managers\NewsletterUserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class NewsletterController extends AbstractController
{
    /**
     * @var NewsletterUserManager
     */
    private $newsletterUserManager;
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * NewsletterController constructor.
     * @param NewsletterUserManager $newsletterUserManager
     * @param Mailer                $mailer
     */
    public function __construct(NewsletterUserManager $newsletterUserManager, Mailer $mailer)
    {
        $this->newsletterUserManager = $newsletterUserManager;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/newsletter", name="app_newsletter")
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request): Response
    {
        $user = new NewsletterUser();
        $form = $this->createForm(NewsletterType::class, $user);
        $form->handleRequest($request);

        // Registers user on valid form submission
        if ($form->isSubmitted() && $form->isValid()) {
            $newUser = $form->getData();
            $newUser->setActive(true);
            $newUser->setHash(str_replace('.', 0, uniqid('', true)));
            $created = $this->newsletterUserManager->save($user);

            if ($created) {
                $this->mailer->sendNewsletterRegistrationEmail($user);
            }

            return $this->redirectToRoute('app_newsletter_registration_completed', [ 'request' => $request ], 307);
        }

        return $this->render('newsletter/index.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newsletter/complete", name="app_newsletter_registration_completed")
     */
    public function registrationCompleted(Request $request)
    {
        if (!$newsletter = $request->request->get('newsletter')) {
            return $this->redirectToRoute('app_preview');
        }

        if (!$email = $newsletter['email'] ?? null) {
            return $this->redirectToRoute('app_preview');
        }

        return $this->render('newsletter/completed.twig', [ 'email' => $email ]);
    }
}
