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
     * Lists all category of product.
     *
     * @Route("/category/{catId}", name="cat_products")
     * @Method("GET")
     * @Template()
     */
    public function categoriesAction($catId)
    {
        /**@var $productModel \Perga\ProductBundle\Services\ProductModel*/
        $productModel = $this->get('perga.model.product');
        $products = $productModel->getProductsByCategoryId($catId);
        $category = $this->getDoctrine()->getRepository('PergaProductBundle:Product')->find($catId);
        return array(
            'products' => $products,
            'category' => $category
        );
    }
    /**
     * Finds and displays a Products entity.
     *
     * @Route("/product/{slug}", name="product_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        /**@var $productModel \Perga\ProductBundle\Services\ProductModel*/
        $productModel = $this->get('perga.model.product');
        $product = $productModel->getProduct($id);

        return array(
            'product'=> $product[0],
        );
    }
}
