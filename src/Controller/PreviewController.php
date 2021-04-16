<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PreviewController
 * @package App\Controller
 */
final class PreviewController extends AbstractController
{
    /**
     * @Route("/", name="app_preview")
     */
    public function index(): Response
    {
        return $this->render('preview/index.twig');
    }
}
