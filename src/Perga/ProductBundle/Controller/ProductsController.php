<?php

namespace Perga\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Perga\ProductBundle\Entity\Products;
use Perga\ProductBundle\Form\ProductsType;

/**
 * Products controller.
 *
 * @Route("/product")
 */
class ProductsController extends Controller
{

    /**
     * Lists all Products entities.
     *
     * @Route("/", name="product")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PergaProductBundle:Products')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Finds and displays a Products entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PergaProductBundle:Products')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Products entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Products entity.
     *
     * @Route("/{id}", name="product_update")
     * @Method("PUT")
     * @Template("PergaProductBundle:Products:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PergaProductBundle:Products')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Products entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProductsType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to delete a Products entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
