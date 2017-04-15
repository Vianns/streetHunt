<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\SessionUser;
use AppBundle\Entity\Session;
use AppBundle\Form\Admin\SessionUserType;

/**
 * @Route("/admin/session_user")
 */
class SessionUserController extends Controller
{
    /**
     * @Route("/new/{id}", name="admin_session_user_new")
     */
    public function newAction(Session $session, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sessionUser = new SessionUser();
        $sessionUser->setSession($session);
        $sessionUser->setCode(strtoupper($random = substr(md5(rand()), 0, 5)));
        $form = $this->createForm(SessionUserType::class, $sessionUser);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($sessionUser);
            $em->flush();

            return $this->redirectToRoute('admin_session_user_edit', ['id' => $sessionUser->getId()]);
        }

        return $this->render('admin/sessionUser/new.html.twig', [
            'form' => $form->createView(),
            'session' => $session,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_session_user_edit")
     */
    public function editAction(SessionUser $sessionUser, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(SessionUserType::class, $sessionUser);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($sessionUser);
            $em->flush();

            return $this->redirectToRoute('admin_session_user_edit', ['id' => $sessionUser->getId()]);
        }

        return $this->render('admin/sessionUser/edit.html.twig', [
            'form' => $form->createView(),
            'sessionUser' => $sessionUser,
            'session' => $sessionUser->getSession(),
        ]);
    }
}
