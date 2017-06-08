<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

/**
 * @Route("/articles")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name="front_article_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('front/article/list.html.twig', [
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->findAll(),
        ]);
    }
}
