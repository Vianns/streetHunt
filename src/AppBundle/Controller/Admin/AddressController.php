<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Address;
use AppBundle\Form\Admin\AddressType;

/**
 * @Route("/admin/address")
 */
class AddressController extends Controller
{
    /**
     * @Route("/{id}", name="admin_user_address_list")
     */
    public function listAction(User $user, Request $request)
    {
        return $this->render('admin/address/list.html.twig', [
            'addresses' => $this->getDoctrine()->getRepository('AppBundle:Address')->findByUser($user),
        ]);
    }

    /**
     * @Route("/new/{id}", name="admin_address_new")
     */
    public function newAction(User $user, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $address = new Address();
        $address->setUser($user);

        $form = $this->createForm(AddressType::class, $address);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('admin_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('admin/address/new.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_address_edit")
     */
    public function editAction(Address $address, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(AddressType::class, $address);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($address);
            $em->flush();

            return $this->redirectToRoute('admin_user_edit', ['id' => $address->getUser()->getId()]);
        }

        return $this->render('admin/address/edit.html.twig', [
            'form' => $form->createView(),
            'address' => $address,
            'user' => $address->getUser(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_address_delete")
     */
    public function deleteAction(Address $address, Request $request)
    {
        $user = $address->getUser();

        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        return $this->redirectToRoute('admin_user_edit', ['id' => $user->getId()]);
    }
}
