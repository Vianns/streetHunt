<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());

            if ($session) {
                return $this->render('front/default/index.html.twig');
            } else {
                return $this->render('front/default/index-no-session.html.twig');
            }
        } else {
            return $this->render('front/default/index-no-logged.html.twig');
        }
    }
}
