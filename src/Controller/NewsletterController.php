<?php

namespace App\Controller;

use App\Entity\NewsletterUser;
use App\Form\NewsletterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function index(Request $request): Response
    {
        $user = new NewsletterUser();
        $form = $this->createForm(NewsletterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // TODO : Handle form
        }

        return $this->render('newsletter/index.twig', [
            'form' => $form->createView()
        ]);
    }
}
