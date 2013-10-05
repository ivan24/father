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

    public  function getCategory()
    {
        $query = $this->entityManager->createQuery ('
            SELECT  p.id, p.name, p.description
            FROM PergaProductBundle:Products p
            WHERE p.parent IS NULL AND p.status = :status
            ORDER BY p.productOrder ASC
        '
        )->setParameter('status', 1);
        return $query->getResult();
    }

    public function getProducts()
    {
        $query = $this->entityManager->createQuery ('
            SELECT  p.id, p.name, p.description
            FROM PergaProductBundle:Products p
            WHERE p.parent IS NOT NULL AND p.status = :status
            ORDER BY p.productOrder ASC
        '
        )->setParameter('status', 1);
        return $query->getResult();
    }

    public function getProduct($id)
    {
        $query = $this->entityManager->createQuery ('
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