<?php

namespace App\Task;

use Symfony\Component\Scheduler\Attribute\AsCronTask;
use Symfony\Component\Scheduler\Attribute\AsPeriodicTask;

##[AsCronTask('* * * * *')]
#[AsPeriodicTask('5 seconds')]
class ProductList
{
    public function __invoke(): void
    {
        dump('TASK TOUTES LES SECONDES');
    }
}
