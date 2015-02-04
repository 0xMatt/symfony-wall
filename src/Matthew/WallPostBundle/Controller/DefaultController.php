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
        return [
            'posts' => $this->getDoctrine()
                ->getRepository('WallPostBundle:WallPost')
                ->findAll(),
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
                ->add($form->getErrors());

            return $this->redirect($this->generateUrl('home'));
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
    }
}
