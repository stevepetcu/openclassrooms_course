<?php

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function indexAction()
    {
        return new Response("Yo world, 'sup?");
    }
}
