<?php

namespace Perga\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Perga\ProductBundle\Entity\Product;
use Perga\ProductBundle\Form\ProductsType;

/**
 * Products controller.
 *
 */
class ProductsController extends Controller
{

     /**
     * @Route("/",name="front-page", options={"sitemap" = true})
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('PergaProductBundle:Product')->findAllProductsFilteredByCategoryAndProductName();
        return array('products' => $products);
    }
    /**
     * Finds and displays a Products entity.
     *
     * @Route("/product/{slug}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('PergaProductBundle:Product')->findProductBySlug($slug);
         //var_dump($product);die;
        return array(
            'product'=> $product,
        );
    }
}
