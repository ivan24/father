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
 * @Route("/products")
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
        $em = $this->getDoctrine ()->getManager ();
        $query = $em->createQuery (
            'Select p FROM PergaProductBundle:Products p
            WHERE p.status = :status
            ORDER BY p.productOrder ASC
            '
        )->setParameters (array('status' => 1));

        $entities = $query->getResult();

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
