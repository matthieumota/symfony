<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testProductListIsSuccessful(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get('doctrine')->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => 'admin@example.com']);
        $client->loginUser($user);

        $crawler = $client->request('GET', '/admin/product/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('table');
        $this->assertSelectorTextContains('table', 'iPhone 15 Pro');
        $this->assertSelectorTextContains('table', '1 239,00 €');
    }
}
