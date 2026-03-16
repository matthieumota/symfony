<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function dashboard(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository,
        UserRepository $userRepository
    ): Response {
        $stats = [
            'categories' => $categoryRepository->count([]),
            'products' => $productRepository->count([]),
            'users' => $userRepository->count([]),
            'lowStock' => $productRepository->countLowStock(),
        ];

        return $this->render('admin/dashboard.html.twig', [
            'stats' => $stats,
        ]);
    }
}
