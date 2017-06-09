<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Session;

/**
 * @Route("/session")
 */
class SessionController extends BaseController
{
    /**
     * @Route("/current", name="session_currents")
     */
    public function currentAction(Request $request)
    {
        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());

        return $this->render('front/session/current.html.twig', [
            'session' => $session,
        ]);
    }

    /**
     * @Route("/currents", name="session_currents")
     */
    public function currentsAction(Request $request)
    {
        return $this->render('front/session/currents.html.twig', [
            'sessions' => $this->getDoctrine()->getRepository('AppBundle:Session')->findCurrent(),
        ]);
    }

    /**
     * Show.
     *
     * @Route("/{id}", name="session_show")
     * @Method({"GET"})
     */
    public function showAction(Session $session, Request $request)
    {
        $userSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session, $this->getUser());

        return $this->render('front/session/show.html.twig', [
            'session' => $session,
            'userSession' => $userSession,
        ]);
    }

    /**
     * Show.
     *
     * @Route("/detail/{id}", name="session_show")
     * @Method({"GET"})
     */
    public function detailsAction(Session $session, Request $request)
    {
        $userSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session, $this->getUser());

        return $this->render('front/session/details.html.twig', [
            'session' => $session,
            'userSession' => $userSession,
        ]);
    }
}
