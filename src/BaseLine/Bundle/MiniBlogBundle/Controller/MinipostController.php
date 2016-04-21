<?php

namespace BaseLine\Bundle\MiniBlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BaseLine\Bundle\MiniBlogBundle\Entity\Minipost;
use BaseLine\Bundle\MiniBlogBundle\Entity\Comment;
use BaseLine\Bundle\MiniBlogBundle\Form\MinipostType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \Symfony\Component\Form\Extension\Core\Type\HiddenType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
/**
 * Minipost controller.
 *
 * @Route("/minipost")
 */
class MinipostController extends Controller
{
    /**
     * Lists all Minipost entities.
     *
     * @Route("/", name="minipost_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $miniposts = $em->getRepository('MiniBlogBundle:Minipost')->findAll();

        return $this->render('minipost/index.html.twig', array(
            'miniposts' => $miniposts,
        ));
    }

    /**
     * Creates a new Minipost entity.
     *
     * @Route("/new", name="minipost_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $minipost = new Minipost();
        $form = $this->createForm('BaseLine\Bundle\MiniBlogBundle\Form\MinipostType', $minipost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($minipost);
            $em->flush();

            return $this->redirectToRoute('minipost_show', array('id' => $minipost->getId()));
        }

        return $this->render('minipost/new.html.twig', array(
            'minipost' => $minipost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Minipost entity.
     *
     * @Route("/{id}", name="minipost_show")
     * @Method("GET")
     */
    public function showAction(Minipost $minipost)
    {
        $comment = new Comment();
        $comment->setMinipost($minipost);
        
        $deleteForm = $this->createDeleteForm($minipost);
        $commentForm = $this->createForm('BaseLine\Bundle\MiniBlogBundle\Form\CommentType', $comment, array( 'action' => $this->generateUrl('comment_new')));
        
        return $this->render('minipost/show.html.twig', array(
            'minipost' => $minipost,
            'delete_form' => $deleteForm->createView(),
            'comment_form' => $commentForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Minipost entity.
     *
     * @Route("/{id}/edit", name="minipost_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Minipost $minipost)
    {
        $deleteForm = $this->createDeleteForm($minipost);
        $editForm = $this->createForm('BaseLine\Bundle\MiniBlogBundle\Form\MinipostType', $minipost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($minipost);
            $em->flush();

            return $this->redirectToRoute('minipost_edit', array('id' => $minipost->getId()));
        }

        return $this->render('minipost/edit.html.twig', array(
            'minipost' => $minipost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Minipost entity.
     *
     * @Route("/{id}", name="minipost_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Minipost $minipost)
    {
        $form = $this->createDeleteForm($minipost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($minipost);
            $em->flush();
        }

        return $this->redirectToRoute('minipost_index');
    }

    /**
     * Creates a form to delete a Minipost entity.
     *
     * @param Minipost $minipost The Minipost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Minipost $minipost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('minipost_delete', array('id' => $minipost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
