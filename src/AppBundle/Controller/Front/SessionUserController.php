<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use AppBundle\Form\Front\TargetType;

class SessionUserController extends BaseController
{
    /**
     * @Route("/mini-target", name="mini_target")
     */
    public function minitargetAction(Request $request)
    {
        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());
        $myUserSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session->getId(), $this->getUser()->getId());
        $target = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndCode($session->getId(), $myUserSession->getTarget());

        $form = $this->createForm(TargetType::class, null, ['target' => $myUserSession->getTarget()]);

        return $this->render('front/sessionUser/mini-target.html.twig', [
            'target' => $target->getUser(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/kill-target", name="kill_target")
     */
    public function killtargetAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());
        $myUserSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session->getId(), $this->getUser()->getId());
        $target = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndCode($session->getId(), $myUserSession->getTarget());

        $form = $this->createForm(TargetType::class, null, ['target' => $myUserSession->getTarget()]);

        if ($form->handleRequest($request)->isValid()) {
            $this->get('app.session_user.service')->killTarget($myUserSession, $target->getCode());
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/mini-card", name="mini_card")
     */
    public function minicardAction(Request $request)
    {
        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());
        $myUserSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session->getId(), $this->getUser()->getId());

        return $this->render('front/sessionUser/mini-card.html.twig', [
            'sessionUser' => $myUserSession,
        ]);
    }
}
