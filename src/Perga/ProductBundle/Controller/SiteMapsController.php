<?php
namespace Perga\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Perga\ProductBundle\Entity\Product;

class SiteMapsController extends Controller
{
    const XML_VIEW = "PergaProductBundle:SiteMaps:sitemap.xml.twig";
    const HTML_VIEW = "PergaProductBundle:SiteMaps:sitemap.html.twig";

    public function siteMapAction(Request $request)
    {
        // Delete xml and add html view for sitemap
        $em = $this->getDoctrine()->getManager();
        $urls = array();
        $staticPages = array();
        $hostname = $request->getHost();
        $staticPages[] = $this->get('router')->generate('front-page');
        $staticPages[] = $this->get('router')->generate('contact');
        $products = $em->getRepository('PergaProductBundle:Product')->findAll();
        foreach ($staticPages as $page) {
            $urls[] = $this->generateXMLItem($page);
        }

        /**@var $product Product */
        foreach ($products as $product) {
            $urls[] = $this->generateXMLItem(
                $this->get('router')->generate('product-show', array('slug' => $product->getSlug())),
                'monthly',
                '1.0'
            );
        }
        $view = self::XML_VIEW;
        return $this->render($view, array('urls' => $urls, 'hostname' => $hostname));
    }

    protected function  generateXMLItem($url, $changefreq = 'monthly', $priority = '1.0')
    {
        $date = new \DateTime();
        return array(
            'loc' => $url,
            'lastmod' => $date->format('Y-m-d'),
            'changefreq' => $changefreq,
            'priority' => $priority);
    }
} 