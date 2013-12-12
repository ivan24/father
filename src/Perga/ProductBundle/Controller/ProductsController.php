<?php

namespace Perga\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Products controller.
 *
 */
class ProductsController extends Controller
{

    public function indexAction()
    {
        $products = $this->getProductRepository()->findAllProductsFilteredByCategoryAndProductName();
        return $this->render('PergaProductBundle:Products:index.html.twig', array('products' => $products));
    }

    public function showAction($slug)
    {
        $product = $this->getProductRepository()->findProductBySlug($slug);
        return $this->render('PergaProductBundle:Products:show.html.twig',array(
            'product'=> $product,
        ));
    }

    public function listAction($exclude = null)
    {
        $products = $this->getProductRepository()->findWhereNot($exclude);
        return $this->render('PergaProductBundle:Products:productsList.html.twig', array('products' => $products));
    }

    /**
     * @return \Perga\ProductBundle\Entity\ProductRepository
     */
    protected function getProductRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository('PergaProductBundle:Product');
    }

}
