<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController
{
    #[Route('/')]
    public function indexAction() : Response
    {
        return new Response('Hello world!');
    }
}