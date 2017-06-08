<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use AppBundle\Form\Admin\ArticleType;

/**
 * @Route("/admin/articles")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name="admin_article_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('admin/article/list.html.twig', [
            'articles' => $this->getDoctrine()->getRepository('AppBundle:Article')->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_article_new")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setCreatedAt(new \DateTime());
        $form = $this->createForm(ArticleType::class, $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_edit', ['id' => $article->getId()]);
        }

        return $this->render('admin/article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="admin_article_edit")
     */
    public function editAction(Article $article, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ArticleType::class, $article);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_edit', ['id' => $article->getId()]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }
}
