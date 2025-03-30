<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StatusController
{
    #[Route('/status')]
    public function statusAction() : Response
    {
        return new Response('OK');
    }
}