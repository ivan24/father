<?php

namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllProductsFilteredByCategoryAndProductName()
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT category.name as catName, product.slug, product.shortDescription, product.name, price.value,price.price, currency.abbr, img.src
                FROM PergaProductBundle:Product product
                JOIN product.category category
                LEFT OUTER JOIN PergaProductBundle:ProductPrice price WITH price.product = product.id
                LEFT OUTER JOIN PergaProductBundle:Currency currency WITH currency.id = price.currency
                LEFT JOIN PergaProductBundle:ProductImages img WITH img.product = product.id
                WHERE product.status = :status
                ORDER BY product.productOrder ASC
             ')->setParameter('status', 1);

        try {
            $result = array();
            $rowResult = $query->getResult();
            foreach ($rowResult as $product) {
                if (!isset($result[$product['catName']])) {
                    $result[$product['catName']] = array();
                }

                if (!isset($result[$product['catName']][$product['name']])) {
                    $result[$product['catName']][$product['name']] = array(
                        'slug' => $product['slug'],
                        'shortDescription' => $product['shortDescription'],
                        'src' => $product['src'],
                    );
                }
                $result[$product['catName']][$product['name']]['prices'][] = array(
                    'value' => $product['value'],
                    'price' => $product['price'],
                    'abbr' => $product['abbr'],

                );

            }
           // var_export($result);die;
            return $result;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
} 