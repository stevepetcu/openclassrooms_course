<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function indexAction(): Response
    {
        $content = $this
            ->get('templating')
            ->render('OpenClassroomsCoursePlatformBundle:Hello:index.html.twig', ['name' => 'Stefan']);

        return new Response($content);
    }
}
