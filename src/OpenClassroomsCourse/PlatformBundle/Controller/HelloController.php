<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function indexAction(): Response
    {
        return new Response("Yo world, 'sup?");
    }
}
