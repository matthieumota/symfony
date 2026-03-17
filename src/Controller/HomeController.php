<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'project_name' => 'Symfony 5 → 7 Migration Demo',
            'sf_version' => '5.4',
        ]);
    }

    #[Route(path: '/exercices', name: 'exercices')]
    public function exercices(ProductRepository $productRepository): Response
    {
        return $this->render('home/exercices.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }
}
