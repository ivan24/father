<?php
namespace Perga\ProductBundle\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductModel
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCategory()
    {
        $query = $this->entityManager->createQuery('
            SELECT  p.id, p.name, p.description
            FROM PergaProductBundle:Products p
            WHERE p.parent IS NULL AND p.status = :status
            ORDER BY p.productOrder ASC
        '
        )->setParameter('status', 1);
        return $query->getResult();
    }

    public function getCategoriesWithProducts()
    {
        $result = array();
        $query = $this->entityManager->createQuery('
            SELECT  product.id, product.name, product.price, category.name as catName, img.src
            FROM PergaProductBundle:Products product
              LEFT JOIN PergaProductBundle:Products category WITH product.parent IS NOT NULL
              LEFT JOIN PergaProductBundle:ProductImages img WITH img.product = product.id
            WHERE product.parent = category.id AND product.status = :status
            ')->setParameter('status', 1);
        $rowResult = $query->getResult();

        foreach ($rowResult as $product) {
            if (!isset($result[$product['catName']])) {
                $result[$product['catName']] = array();
            }

            $result[$product['catName']][] = array(
                'src' => $product['src'],
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price']
            );
        }
        return $result;
    }

    public function getProducts()
    {
        $query = $this->entityManager->createQuery('
            SELECT  p.id, p.name, p.price
            FROM PergaProductBundle:Products p
            WHERE p.parent IS NOT NULL AND p.status = :status
            ORDER BY p.productOrder ASC
        '
        )->setParameter('status', 1);
        return $query->getResult();
    }

    public function getProduct($id)
    {
        $query = $this->entityManager->createQuery('
            SELECT  p.id, p.name, p.description, p.price, p.status
            FROM PergaProductBundle:Products p
            WHERE p.id = :id
        ')->setParameter('id', $id);
        $product = $query->getResult();
        if (!$product) {
            throw new NotFoundHttpException('Unable to find Products entity.', null, 404);
        }
        return $product;
    }


}