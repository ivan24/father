<?php

namespace Perga\AdminBundle\Controller;

use Sonata\AdminBundle\Admin\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{
    //set a custom URL for a given this class
    protected $baseRoutePattern = 'product';

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, array('label' => "Имя"))
            ->add('category', null, array('label' => "Категория"))
            ->add('shortDescription', null, array('label' => "Краткое описание",'attr' => array('class' => 'tinymce-sd')))
            ->add('description', null, array('label' => "Подробное описание",'attr' => array('class' => 'tinymce-d')))
            ->add('metaKeyword', null, array('label' => "meta keyword"))
            ->add('metaDescription', null, array('label' => "meta description"))
            ->add(
                'prices',
                'sonata_type_collection',
                array(
                    'by_reference' => false,
                    'label' => "Цены"
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'allow_delete' => true
                )
            )
            ->add('productOrder', null, array('label' => "Порядковый номер продукта"))
            ->add('status', null, array('label' => "Наличие"));
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category', null, array('label' => "Категория"))
            ->add('name', null, array('label' => "Имя"))
            //  ->add('prices')
            ->add('productOrder', null, array('label' => "Порядковый номер продукт"))
            ->add('status', null, array('label' => "Наличие"));
    }

    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('category', null, array('label' => "Категория"))
            ->add('name', null, array('label' => "Имя"))
            ->add('shortDescription', null, array('label' => "Краткое описание"))
            ->add('description', null, array('label' => "Подробное описание"))
            ->add('metaKeyword', null, array('label' => "meta keyword"))
            ->add('metaDescription', null, array('label' => "meta description"))
            ->add('prices', null, array('label' => "Цены"))
            ->add('productOrder', null, array('label' => "Порядковый номер продукта"))
            ->add('status', null, array('label' => "Наличие"));

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
// Example: change route for field parent from  edit to show
        $listMapper
            ->addIdentifier('name', null, array('label' => "Имя"))
            ->addIdentifier('category', null, array(
                'route' => array('name' => 'show'),
                array('label' => "Категория")
            ))
            ->add('shortDescription', null, array('label' => "Краткое описание"))
            ->add('description', null, array('label' => "Подробное описание"))
            ->add('metaKeyword', null, array('label' => "meta keyword"))
            ->add('metaDescription', null, array('label' => "meta description"))
            ->add('prices', null, array('label' => "Цены"))
            ->add('productOrder', null, array('label' => "Порядковый номер продукта"))
            ->add('status', null, array('label' => "Наличие"));
    }
}