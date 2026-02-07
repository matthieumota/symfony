<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->createUsers($manager);
        $categories = $this->createCategories($manager);
        $this->createProducts($manager, $categories);

        $manager->flush();
    }

    private function createUsers(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setName('Administrateur');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        $user = new User();
        $user->setEmail('user@example.com');
        $user->setName('Utilisateur Test');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user123'));
        $manager->persist($user);
    }

    private function createCategories(ObjectManager $manager): array
    {
        $categories = [];

        $category1 = new Category();
        $category1->setName('Électronique');
        $category1->setSlug('electronique');
        $category1->setDescription('Appareils électroniques et gadgets');
        $manager->persist($category1);
        $categories['electronique'] = $category1;

        $category2 = new Category();
        $category2->setName('Vêtements');
        $category2->setSlug('vetements');
        $category2->setDescription('Mode et accessoires');
        $manager->persist($category2);
        $categories['vetements'] = $category2;

        $category3 = new Category();
        $category3->setName('Maison & Jardin');
        $category3->setSlug('maison-jardin');
        $category3->setDescription('Décoration et équipement maison');
        $manager->persist($category3);
        $categories['maison-jardin'] = $category3;

        $category4 = new Category();
        $category4->setName('Sports & Loisirs');
        $category4->setSlug('sports-loisirs');
        $category4->setDescription('Équipement sportif et loisirs');
        $manager->persist($category4);
        $categories['sports-loisirs'] = $category4;

        $category5 = new Category();
        $category5->setName('Livres & Papeterie');
        $category5->setSlug('livres-papeterie');
        $category5->setDescription('Livres, fournitures et bureautique');
        $manager->persist($category5);
        $categories['livres-papeterie'] = $category5;

        $category6 = new Category();
        $category6->setName('Alimentation');
        $category6->setSlug('alimentation');
        $category6->setDescription('Produits alimentaires et boissons');
        $manager->persist($category6);
        $categories['alimentation'] = $category6;

        $category7 = new Category();
        $category7->setName('Informatique');
        $category7->setSlug('informatique');
        $category7->setDescription('Ordinateurs, logiciels et accessoires');
        $manager->persist($category7);
        $categories['informatique'] = $category7;

        $category8 = new Category();
        $category8->setName('Beauté & Santé');
        $category8->setSlug('beaute-sante');
        $category8->setDescription('Cosmétiques et produits de santé');
        $manager->persist($category8);
        $categories['beaute-sante'] = $category8;

        return $categories;
    }

    private function createProducts(ObjectManager $manager, array $categories): void
    {
        $productsData = [
            ['name' => 'iPhone 15 Pro', 'slug' => 'iphone-15-pro', 'price' => '1229.00', 'quantity' => 15, 'category' => 'electronique', 'description' => 'Smartphone Apple dernière génération'],
            ['name' => 'Samsung Galaxy S24', 'slug' => 'samsung-galaxy-s24', 'price' => '899.00', 'quantity' => 22, 'category' => 'electronique', 'description' => 'Smartphone Android haut de gamme'],
            ['name' => 'MacBook Air M3', 'slug' => 'macbook-air-m3', 'price' => '1499.00', 'quantity' => 8, 'category' => 'informatique', 'description' => 'Ordinateur portable ultra-léger'],
            ['name' => 'T-Shirt Premium Coton', 'slug' => 't-shirt-premium-coton', 'price' => '29.99', 'quantity' => 100, 'category' => 'vetements', 'description' => 'T-shirt 100% coton bio'],
            ['name' => 'Jean Slim Fit', 'slug' => 'jean-slim-fit', 'price' => '79.99', 'quantity' => 45, 'category' => 'vetements', 'description' => 'Jean denim stretch confortable'],
            ['name' => 'Veste Polaire', 'slug' => 'veste-polaire', 'price' => '59.99', 'quantity' => 30, 'category' => 'vetements', 'description' => 'Veste chaude pour hiver'],
            ['name' => 'Lampe LED Design', 'slug' => 'lampe-led-design', 'price' => '49.99', 'quantity' => 25, 'category' => 'maison-jardin', 'description' => 'Lampe de bureau moderne'],
            ['name' => 'Plante Artificielle Monstera', 'slug' => 'plante-artificielle-monstera', 'price' => '35.00', 'quantity' => 18, 'category' => 'maison-jardin', 'description' => 'Décoration verte sans entretien'],
            ['name' => 'Tapis de Yoga Premium', 'slug' => 'tapis-yoga-premium', 'price' => '45.00', 'quantity' => 40, 'category' => 'sports-loisirs', 'description' => 'Tapis antidérapant épaisseur 6mm'],
            ['name' => 'Haltères Ajustables 20kg', 'slug' => 'haltères-ajustables-20kg', 'price' => '89.99', 'quantity' => 12, 'category' => 'sports-loisirs', 'description' => 'Set d\'haltères modulables'],
            ['name' => 'Symfony 7 - Le Guide Complet', 'slug' => 'symfony-7-guide-complet', 'price' => '39.99', 'quantity' => 50, 'category' => 'livres-papeterie', 'description' => 'Formation Symfony 5 vers 7'],
            ['name' => 'Carnet de Notes Moleskine', 'slug' => 'carnet-moleskine', 'price' => '19.99', 'quantity' => 75, 'category' => 'livres-papeterie', 'description' => 'Carnet premium couverture souple'],
            ['name' => 'Café Bio Équitable 500g', 'slug' => 'cafe-bio-equitable-500g', 'price' => '12.99', 'quantity' => 60, 'category' => 'alimentation', 'description' => 'Café torréfié origine Éthiopie'],
            ['name' => 'Thé Vert Sencha', 'slug' => 'the-vert-sencha', 'price' => '8.50', 'quantity' => 40, 'category' => 'alimentation', 'description' => 'Thé japonais bio'],
            ['name' => 'Crème Hydratante Visage', 'slug' => 'creme-hydratante-visage', 'price' => '24.99', 'quantity' => 35, 'category' => 'beaute-sante', 'description' => 'Hydratation 24h peaux normales à sèches'],
            ['name' => 'Shampoing Solide Naturel', 'slug' => 'shampoing-solide-naturel', 'price' => '9.99', 'quantity' => 55, 'category' => 'beaute-sante', 'description' => 'Shampoing zéro déchet'],
        ];

        foreach ($productsData as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setSlug($data['slug']);
            $product->setPrice($data['price']);
            $product->setQuantity($data['quantity']);
            $product->setDescription($data['description']);
            $product->setCategory($categories[$data['category']]);

            $manager->persist($product);
        }
    }
}
