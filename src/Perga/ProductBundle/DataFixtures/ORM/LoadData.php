<?php
/**
 * @author Ivan Oreshkov ivan.oreshkov@itstartuplabs.com
 */

namespace Perga\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Mapping\Fixture\Document\User;
use Perga\ProductBundle\Entity\Currency;
use Perga\ProductBundle\Entity\PageBlock;
use Perga\ProductBundle\Entity\Product;
use Perga\ProductBundle\Entity\ProductCategories;
use Perga\ProductBundle\Entity\ProductImages;
use Perga\ProductBundle\Entity\ProductPrice;

class LoadData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
/*        $dsn = 'mysql:host=localhost;dbname=myProduction;charset=utf8';
        $user = 'root';
        $password = 'root';

        try {
            $production = new \PDO($dsn, $user, $password);
            $production->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT p.name, p.page_title FROM products as p WHERE p.parent_id is NULL";

            $categories = $production->query($sql, \PDO::FETCH_ASSOC);
            $products = $production->query("SELECT p.name, p.page_title, p.short_description, p.description FROM products as p WHERE p.parent_id is NOT NULL",\PDO::FETCH_ASSOC);
            $fCat = new ProductCategories();
            foreach ($categories as $category) {
                $fCat->setName($category['name']);
                //$manager->persist($fCat);
            }
            $fprod = new Product();
            foreach($products as $product) {
                $fprod->setCategory($fCat);
                $fprod->setName($product['name']);
                $fprod->setDescription($product['description']);
                $fprod->setShortDescription($product['short_description']);
               // $fprod->($product['name']);
                var_dump($product);
            }

            //$manager->flush();

        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }*/
    }
}