<?php
namespace Matthew\WallPostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Matthew\WallPostBundle\Form\Type\WallPostType;
use Matthew\WallPostBundle\Entity\WallPost;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="home")
     * @Template("WallPostBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sql   = "SELECT a FROM WallPostBundle:WallPost a ORDER BY a.create_date DESC";
        $entities = $em->createQuery($sql);

        // Creating pagnination
        $paginator  = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $entities,
            $this->get('request')->query->get('page', 1),
            3
        );

        return [
            'posts' => $posts,
            'form' => $this->createForm(new WallPostType(), new WallPost())->createView()
        ];
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction(Request $request)
    {
        $post = new WallPost();

        $form = $this->createForm(new WallPostType(), $post);

        $form->handleRequest($request);

        if (! $form->isValid()) {
            $request->getSession()
                ->getFlashBag()
                ->add('errors', 'The title must be between 10 and 40 characters');

            return $this->redirectToRoute('home');
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('notices', 'Your post has been made successfully!');

        return $this->redirectToRoute('home');
    }
}
