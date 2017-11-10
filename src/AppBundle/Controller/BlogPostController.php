<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogPost;
use AppBundle\Form\BlogPostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BlogPostController
 *
 * @package AppBundle\Controller\Api
 */
class BlogPostController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Route("/blog-post/list", name="blog_post_list")
     */
    public function listAction(Request $request)
    {
        $repository = $this->get('doctrine.orm.entity_manager')->getRepository(BlogPost::class);
        $list = $repository->findAll();

        return $this->render('@App/BlogPost/list.html.twig', [
            'list' => $list
        ]);
    }

    /**
     * @Route("/blog-post/edit/{post}", name="blog_post_edit")
     */
    public function addAction(Request $request, BlogPost $post = null)
    {
        $model = $post ?? new BlogPost();
        $form = $this->createForm(BlogPostType::class, $model, [
            'method' => 'put'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($model);
                $em->flush();

                return $this->redirectToRoute('blog_post_list');
            }
        }

        return $this->render('@App/BlogPost/edit.html.twig', [
            'form_post' => $form->createView()
        ]);
    }
}
