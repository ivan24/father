<?php

namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAllProductsFilteredByCategoryAndProductName()
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT
                  category.name as catName,
                  product.slug,
                  product.shortDescription,
                  product.name,
                  price.value,
                  price.price,
                  currency.abbr,
                  img.src
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
            return $result;
        } catch (\Doctrine\ORM\NoResultException $e) {
            return array();
        }
    }

    public function findProductBySlug($slug)
    {
        //todo how I make this better
        $query = $this->getEntityManager()->createQuery('
                SELECT
                  product.id,
                  product.name,
                  product.metaKeyword,
                  product.metaDescription,
                  product.description,
                  price.value,
                  price.price,
                  currency.abbr,
                  img.src
                FROM PergaProductBundle:Product product
                LEFT JOIN PergaProductBundle:ProductPrice price WITH price.product = product.id
                LEFT JOIN PergaProductBundle:Currency currency WITH currency.id = price.currency
                LEFT JOIN PergaProductBundle:ProductImages img WITH img.product = product.id
                WHERE product.slug = :slug
             ')->setParameter('slug', $slug);

        try {
            $result = array();
            $rowResult = $query->getResult();
            foreach ($rowResult as $product) {
                if (!isset($result[$product['name']])) {
                    $result[$product['name']] = array(
                        'id'=> $product['id'],
                        'name'=> $product['name'],
                        'metaKeyword' => $product['metaKeyword'],
                        'metaDescription' => $product['metaDescription'],
                        'description' => $product['description'],
                        'src' => $product['src'],
                        'prices' => array(),
                    );
                }

                $result[$product['name']]['prices'][] = array(
                    'value' => $product['value'],
                    'price' => $product['price'],
                    'abbr' => $product['abbr'],

                );
            }
            $result = array_shift($result);

        } catch (\Doctrine\Orm\NoResultException $e) {
            $result = array();
        }
        return $result;
    }

    public function findWhereNot($exclude = null)
    {
        if(is_null($exclude)) {
            $exclude = "";
        }
        $qb = $this->getEntityManager()->createQuery('
                SELECT
                  product.slug,
                  product.name
                FROM PergaProductBundle:Product product
                WHERE product.id <> :id')
            ->setParameter('id', $exclude);
        try {
            $result = $qb->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $result = array();
        }

        return $result;
    }
} 