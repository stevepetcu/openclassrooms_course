<?php

declare(strict_types=1);

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Exception;
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
