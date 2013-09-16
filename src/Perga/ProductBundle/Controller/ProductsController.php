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
 */
class ProductsController extends Controller
{

     /**
     * @Route("/",name="front-page")
     * @Template()
     */
    public function indexAction($name='')
    {
        return array('name' => $name);
    }
    /**
     * Lists all category of product.
     *
     * @Route("/products", name="product")
     * @Method("GET")
     * @Template()
     */
    public function categoriesAction()
    {
        $em = $this->getDoctrine ()->getManager ();
        $query = $em->createQuery ('
            SELECT  p.id, p.name, p.description
            FROM PergaProductBundle:Products p
            WHERE p.parent IS NULL AND p.status = :status
            ORDER BY p.productOrder ASC
        '
        )->setParameter('status', 1);
        $productCategories = $query->getResult();

        return array(
            'productCategories' => $productCategories,
        );
    }
    /**
     * Finds and displays a Products entity.
     *
     * @Route("/product/{id}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine ()->getManager ();

        $query = $em->createQuery ('
            SELECT  p.id, p.name, p.description, p.price, p.status
            FROM PergaProductBundle:Products p
            WHERE p.parent = :parent
        ')->setParameter('parent', $id);
        $products = $query->getResult();
        if (!$products) {
            throw $this->createNotFoundException('Unable to find Products entity.');
        }

        return array(
            'products'=> $products,
        );
    }
}
