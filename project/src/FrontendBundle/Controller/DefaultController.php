<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function defaultAction()
    {
        return $this->render('FrontendBundle:Default:index.html.twig');
    }
}
