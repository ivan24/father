<?php
namespace Perga\AdminBundle\Controller;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductCategoriesAdmin extends Admin
{
//set a custom URL for a given this class
    protected $baseRoutePattern = 'product-categories';

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('label' => "Имя Категории"))
            ->add('products', null, array('label' => "Продукты", 'required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id', null, array('label' => "Индификационный номер"))
            ->add('products.name', null, array('label' => "Продукт"))
            ->add('name', null, array('label' => "Имя Категории"));
    }

    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name', null, array('label' => "Имя Категории"))
            ->add('products', null, array('label' => "Продукты"));

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier(
                'id',
                null,
                array(
                    'route' => array('name' => 'show')
                ))
            ->addIdentifier(
                'name',
                null,
                array(
                    'route' => array('name' => 'edit'),
                    'label' => "Имя Категории"
                ))
            ->add(
                'products',
                null,
                array(
                    'label' => "Продукты"
                )
            );
    }

    public function prePersist($category)
    {
        foreach ($category->getProducts() as $product) {
            $product->setCategory($category);
        }
    }

    public function preUpdate($category)
    {

        foreach ($category->getProducts() as $product) {
            $product->setCategory($product->getCategory());
        }
        $category->setProducts($category->getProducts());
    }
}