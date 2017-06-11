<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    /**
     * Lists all active advertisements.
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $content = $this
            ->get('templating')
            ->render('OpenClassroomsCoursePlatformBundle:Advert:index.html.twig');

        return new Response($content);
    }

    /**
     * Displays the advertisement identified by `$id`.
     *
     * @param int $id
     *
     * @return Response
     */
    public function viewAction(int $id): Response
    {
        $content = $this
            ->get('templating')
            ->render('OpenClassroomsCoursePlatformBundle:Advert:view.html.twig', compact('id'));

        return new Response($content);
    }


    /**
     * Returns a list of all the advertisements `$author` has created in `$year`.
     * The `$format` of the response can be either HTML, or XML.
     *
     * @param int $year
     * @param string $author
     * @param string $format
     *
     * @return Response
     */
    public function viewSlugAction(int $year, string $author, string $format): Response
    {
        if ('html' == $format) {
            $content = $this
                ->get('templating')
                ->render(
                    'OpenClassroomsCoursePlatformBundle:Advert:view_slug.html.twig',
                    compact('year', 'author')
                );

            return new Response($content);
        }

        return new JsonResponse(compact('year', 'author'));
    }
}
