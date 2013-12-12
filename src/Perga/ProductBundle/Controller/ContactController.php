<?php

namespace Perga\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction($name = '')
    {
        return $this->render('PergaProductBundle:Contact:index.html.twig', array('name' => $name));
    }
}
