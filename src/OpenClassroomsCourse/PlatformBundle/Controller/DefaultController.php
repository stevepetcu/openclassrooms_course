<?php

namespace OpenClassroomsCourse\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OpenClassroomsCoursePlatformBundle:Default:index.html.twig');
    }
}
