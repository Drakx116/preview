<?php

namespace App\Controller;

use App\Entity\NewsletterUser;
use App\Form\NewsletterType;
use App\Services\Managers\NewsletterUserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    /**
     * @var NewsletterUserManager
     */
    private $newsletterUserManager;

    /**
     * NewsletterController constructor.
     * @param NewsletterUserManager $newsletterUserManager
     */
    public function __construct(NewsletterUserManager $newsletterUserManager)
    {
        $this->newsletterUserManager = $newsletterUserManager;
    }

    /**
     * @Route("/newsletter", name="newsletter")
     * @param Request $request
     * @return Response
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
            $this->newsletterUserManager->save($user);
        }

        return $this->render('newsletter/index.twig', [
            'form' => $form->createView()
        ]);
    }
}
