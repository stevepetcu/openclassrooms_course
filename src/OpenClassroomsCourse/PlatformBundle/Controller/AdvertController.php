<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Exception;
use OpenClassroomsCourse\PlatformBundle\Entity\Advert;
use OpenClassroomsCourse\PlatformBundle\Filter\SpamFilter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    private const ADVERTS = [
        1 => [
            'title' => 'Recherche développpeur Symfony',
            'id' => 1,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date' => 'now'
        ],
        2 => [
            'title' => 'Mission de webmaster',
            'id' => 2,
            'author' => 'Hugo',
            'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
            'date' => 'now'
        ],
        3 => [
            'title' => 'Offre de stage webdesigner',
            'id' => 3,
            'author' => 'Mathieu',
            'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
            'date' => 'now'
        ]
    ];

    /**
     * Renders the left-side website menu.
     *
     * @param $limit
     *
     * @return Response
     */
    public function menuAction($limit)
    {
        $adverts = self::ADVERTS;

        return $this->render('OpenClassroomsCoursePlatformBundle:Advert:menu.html.twig', compact('adverts'));
    }

    /**
     * Lists all active advertisements.
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        $adverts = self::ADVERTS;

        return $this->render('OpenClassroomsCoursePlatformBundle:Advert:index.html.twig', compact('adverts'));
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
        $em = $this->getDoctrine()->getManager();

        $adRepository = $em->getRepository('OpenClassroomsCoursePlatformBundle:Advert');

        $ad = $adRepository->find($id);

        if (null === $ad) {
            throw new NotFoundHttpException('The requested ad was not found.');
        }

        return $this->render('OpenClassroomsCoursePlatformBundle:Advert:view.html.twig', compact('ad'));
    }

    /**
     * Displays a form for creating a new ad.
     *
     * @return Response
     */
    public function addAction(): Response
    {
        return $this->render(
            'OpenClassroomsCoursePlatformBundle:Advert:add.html.twig',
            [
                'method' => 'POST'
            ]
        );
    }

    /**
     * Creates a new advert.
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws Exception
     */
    public function postAction(Request $request): Response
    {
        /** @var SpamFilter $spamFilter */
        $spamFilter = $this->get('openclassroomscourse_platform.spam_filter');

        if ($spamFilter->isSpam($request->request->get('content'))) {
            throw new Exception('The ad content is too short!');
        }

        $ad = new Advert();

        $ad->setTitle($request->request->get('title'));
        $ad->setAuthor($request->request->get('author'));
        $ad->setContent($request->request->get('content'));

        $em = $this->getDoctrine()->getManager();

        $em->persist($ad);
        $em->flush();

        $id = $ad->getId();

        return $this->redirectToRoute(
            'openclassroomscourse_platform_view',
            compact('id', 'advert'),
            303
        );
    }

    /**
     * Displays the form to edit the advertisement identified by `$id`.
     *
     * @param int $id
     *
     * @return Response
     */
    public function editAction(int $id): Response
    {
        $content = $this
            ->render(
                'OpenClassroomsCoursePlatformBundle:Advert:edit.html.twig',
                [
                    'advert' => self::ADVERTS[$id]
                ]
            );

        return new Response($content);
    }

    /**
     * Deletes the advertisement identified by `$id`.
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteAction(int $id): Response
    {
        // Delete code will be here.

        return new Response('Deleting ads will be implemented soon!');
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
                ->render(
                    'OpenClassroomsCoursePlatformBundle:Advert:view_slug.html.twig',
                    compact('year', 'author')
                );

            return new Response($content);
        }

        return new JsonResponse(compact('year', 'author'));
    }

    /**
     * Test the redirect method.
     *
     * @return RedirectResponse
     */
    public function redirectAction(): RedirectResponse
    {
        return $this->redirectToRoute('openclassroomscourse_platform_index');
    }

    /**
     * Get the active session.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getSessionAction(Request $request): JsonResponse
    {
        $session = $request->getSession();

        return new JsonResponse($session->all());
    }

    /**
     * Start a session.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function startSessionAction(Request $request): Response
    {
        $session = $request->getSession();

        if (!$session->isStarted()) {
            $session->start();
        }

        $url = $this->generateUrl(
            'openclassroomscourse_session_get',
            [],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return new Response('', 204, ['Link' => $url]);
    }

    /**
     * Patch a session.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function patchSessionAction(Request $request): Response
    {
        try {
            if ($request->headers->get('Content-Type') != 'application/json') {
                throw new UnsupportedMediaTypeHttpException("Unsupported media type. Expecting 'application/json'");
            }

            $session = $request->getSession();

            if (!$session->isStarted()) {
                throw new NotFoundHttpException("No active session found! Please create a session.");
            }

            foreach (json_decode($request->getContent(), true) as $key => $attribute) {
                $session->set($key, $attribute);
            }

            $session->save();

            $url = $this->generateUrl(
                'openclassroomscourse_session_get',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            return new Response('', 204, ['Link' => $url]);
        } catch (UnsupportedMediaTypeHttpException|NotFoundHttpException $exception) {
            return new JsonResponse(
                [
                    'message' => $exception->getMessage()
                ],
                $exception->getStatusCode()
            );
        } catch (Exception $exception) {
            return new JsonResponse(
                [
                    'message' => "We encountered an unexpected error. Please come back later."
                ],
                500
            );
        }
    }
}
