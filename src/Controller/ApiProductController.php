<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/products')]
class ApiProductController extends AbstractController
{
    #[Route(path: '/search', name: 'product_search', methods: ['GET'])]
    public function search(Request $request, ProductRepository $productRepository): JsonResponse
    {
        $q = $request->query->get('q', '');

        $products = $productRepository->search($q);

        $data = array_map(fn($product) => [
            'id'    => $product->getId(),
            'name'  => $product->getName(),
            'price' => $product->getPrice(),
        ], $products);

        return $this->json($data);
    }
}
