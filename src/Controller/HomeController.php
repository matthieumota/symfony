<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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
    public function exercices(ProductRepository $productRepository, ChartBuilderInterface $chartBuilder, CategoryRepository $categoryRepository): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $categories = $categoryRepository->findAll();
        $chart->setData([
            'labels' => array_map(fn($c) => $c->getName(), $categories),
            'datasets' => [
                [
                    'label' => 'Quantité',
                    'data' => array_map(fn($c) => count($c->getProducts()), $categories),
                    'backgroundColor' => array_map(fn($c) => sprintf('hsl(%d, 70%%, 50%%)', rand(0, 360)), $categories),
                ],
            ],
        ]);

        return $this->render('home/exercices.html.twig', [
            'products' => $productRepository->findAll(),
            'chart' => $chart,
        ]);
    }
}
