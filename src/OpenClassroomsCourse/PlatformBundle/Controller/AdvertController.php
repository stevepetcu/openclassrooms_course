<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction(): Response
    {
        $content = $this
            ->get('templating')
            ->render('OpenClassroomsCoursePlatformBundle:Advert:index.html.twig', ['name' => 'Stefan']);

        return new Response($content);
    }
}
