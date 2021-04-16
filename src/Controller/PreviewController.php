<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\NonUniqueResultException;
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
     * @throws NonUniqueResultException
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('preview/index.twig', [
            'product' => $productRepository->findLastProduct()
        ]);
    }
}
