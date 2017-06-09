<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use AppBundle\Form\Front\TargetType;
use AppBundle\Form\Front\SessionUserType;
use AppBundle\Entity\Session;
use AppBundle\Entity\SessionUser;

/**
 * @Route("/session-user")
 */
class SessionUserController extends BaseController
{
    /**
     * @Route("/new/{id}", name="new_user_session")
     */
    public function newAction(Session $session, Request $request)
    {
        $usr = $this->get('security.token_storage')->getToken()->getUser();

        $form = $this->createForm(SessionUserType::class, $usr);

        if ($form->handleRequest($request)->isValid()) {
            $this->get('app.session_user.service')->newUser($usr, $session);

            return $this->redirectToRoute('session_show', ['id' => $session->getId()]);
        }

        return $this->render('front/sessionUser/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mini-target", name="mini_target")
     */
    public function miniTargetAction(Request $request)
    {
        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());
        $myUserSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session->getId(), $this->getUser()->getId());

        if (SessionUser::STATUS_VALIDATED === $myUserSession->getStatus()) {
            $target = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndCode($session->getId(), $myUserSession->getTarget());

            $form = $this->createForm(TargetType::class, null, ['target' => $myUserSession->getTarget()]);

            return $this->render('front/sessionUser/mini-target.html.twig', [
                'target' => $target->getUser(),
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('front/sessionUser/not-validated.html.twig');
        }
    }

    /**
     * @Route("/kill-target", name="kill_target")
     */
    public function killTargetAction(Request $request)
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
    public function miniCardAction(Request $request)
    {
        $session = $this->getDoctrine()->getRepository('AppBundle:Session')->findByUser($this->getUser());
        $myUserSession = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findBySessionAndUser($session->getId(), $this->getUser()->getId());

        return $this->render('front/sessionUser/mini-card.html.twig', [
            'sessionUser' => $myUserSession,
        ]);
    }
}
