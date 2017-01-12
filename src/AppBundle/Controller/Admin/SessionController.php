<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Session;
use UserBundle\Form\Admin\SessionType;

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
}
