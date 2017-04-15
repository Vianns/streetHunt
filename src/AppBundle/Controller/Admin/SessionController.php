<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Session;
use AppBundle\Entity\SessionUser;
use AppBundle\Form\Admin\SessionType;

/**
 * @Route("/admin/sessions")
 */
class SessionController extends Controller
{
    /**
     * @Route("/", name="admin_session_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('admin/session/list.html.twig', [
            'sessions' => $this->getDoctrine()->getRepository('AppBundle:Session')->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_session_new")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $session = new Session();
        $form = $this->createForm(SessionType::class, $session);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('admin_session_edit', ['id' => $session->getId()]);
        }

        return $this->render('admin/session/new.html.twig', [
            'form' => $form->createView(),
            'session' => $session,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_session_edit")
     */
    public function editAction(Session $session, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SessionType::class, $session);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($session);
            $em->flush();

            return $this->redirectToRoute('admin_session_edit', ['id' => $session->getId()]);
        }

        return $this->render('admin/session/edit.html.twig', [
            'form' => $form->createView(),
            'session' => $session,
        ]);
    }

    /**
     * @Route("/generate-game/{id}", name="admin_session_generate")
     */
    public function generateGameAction(Session $session)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ($session->getSessionUsers() as $sessionUser) {
            if ($sessionUser->getStatus() !== SessionUser::STATUS_REGISTER) {
                if (null === $sessionUser->getCode()) {
                    $sessionUser->setCode(strtoupper($random = substr(md5(rand()), 0, 5)));
                }

                $sessionUser->setTarget(null);
                $sessionUser->setKilledBy(null);

                $sessionUser->setStatus(SessionUser::STATUS_VALIDATED);

                $em->persist($sessionUser);
            }
        };

        $em->flush();

        foreach ($session->getSessionUsers() as $sessionUser) {
            if ($sessionUser->getStatus() !== SessionUser::STATUS_REGISTER) {
                if (null === $sessionUser->getKilledBy()) {
                    $target = $this->getDoctrine()->getRepository('AppBundle:SessionUser')->findTarget(
                        $sessionUser->getSession()->getId(),
                        $sessionUser->getId()
                    );

                    $sessionUser->setTarget($target);

                    $em->persist($sessionUser);
                    $em->flush();
                }
            }
        }

        return $this->redirectToRoute('admin_session_edit', ['id' => $session->getId()]);
    }
}
