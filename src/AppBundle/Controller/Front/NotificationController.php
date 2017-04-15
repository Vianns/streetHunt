<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NotificationController extends Controller
{
    /**
     * @Route("/actuality", name="actuality")
     */
    public function actualityAction(Request $request)
    {
        return $this->render('front/notification/actuality.html.twig');
    }
}
