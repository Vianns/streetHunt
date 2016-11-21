<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\Security\Core\Security;

class UserController extends BaseController
{
    /**
     * @Route("/user-menu", name="user_menu")
     */
    public function menuAction(Request $request)
    {
        return $this->render('front/default/user-menu.html.twig', [
            'logged' => $this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'),
        ]);
    }
}
