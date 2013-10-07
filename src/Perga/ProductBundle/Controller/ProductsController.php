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
    public function indexAction()
    {
        /**@var $productModel \Perga\ProductBundle\Services\ProductModel */
        $productModel = $this->get('perga.model.product');
        $products = $productModel->getProducts();
        return array('products' => $products);
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
        /**@var $productModel \Perga\ProductBundle\Services\ProductModel*/
        $productModel = $this->get('perga.model.product');
        $productCategories = $productModel->getCategory();
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
        /**@var $productModel \Perga\ProductBundle\Services\ProductModel*/
        $productModel = $this->get('perga.model.product');
        $product = $productModel->getProduct($id);

        return array(
            'product'=> $product[0],
        );
    }
}
