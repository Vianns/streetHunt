<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Session;

class SessionController extends BaseController
{
    /**
     * @Route("/session-currents", name="session_currents")
     */
    public function currentsAction(Request $request)
    {
        return $this->render('front/session/current.html.twig', [
            'sessions' => $this->getDoctrine()->getRepository('AppBundle:Session')->findCurrent(),
        ]);
    }

    /**
     * Show.
     *
     * @Route("/session/{id}", name="session_show")
     * @Method({"GET"})
     */
    public function showAction(Session $session, Request $request)
    {
        return $this->render('front/session/show.html.twig', [
            'session' => $session,
        ]);
    }
}
