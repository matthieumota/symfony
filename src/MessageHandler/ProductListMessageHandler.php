<?php

namespace App\MessageHandler;

use App\Message\ProductListMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ProductListMessageHandler
{
    public function __invoke(ProductListMessage $message): void
    {
        dump('LISTE DES PRODUITS TOUTES LES HEURES');
    }
}
