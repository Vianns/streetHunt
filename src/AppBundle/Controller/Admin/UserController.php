<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use UserBundle\Form\Admin\UserType;

/**
 * @Route("/admin/users")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="admin_user_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('admin/user/list.html.twig', [
            'users' => $this->getDoctrine()->getRepository('AppBundle:User')->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_user_new")
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user);

            return $this->redirectToRoute('admin_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('admin/user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_user_edit")
     */
    public function editAction(User $user, Request $request)
    {
        $form = $this->createForm(UserType::class, $user);

        if ($form->handleRequest($request)->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user);

            return $this->redirectToRoute('admin_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
