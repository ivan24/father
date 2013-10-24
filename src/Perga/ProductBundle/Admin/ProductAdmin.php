<?php

namespace Perga\ProductBundle\Admin;

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
            ->add('parent')
            ->add('name')
            ->add('pageTitle')
            ->add('shortDescription', null, array('attr' => array('class' => 'tinymce-sd')))
            ->add('description', null, array('attr' => array('class' => 'tinymce-d')))
            ->add('price')
            ->add('productOrder')
            ->add('status');
        ;
    }
    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('parent')
            ->add('name')
            ->add('price')
            ->add('productOrder')
            ->add('status');
        ;
    }

    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('parent')
            ->add('name')
            ->add('pageTitle')
            ->add('shortDescription')
            ->add('description')
            ->add('price')
            ->add('productOrder')
            ->add('status');

    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
// Example: change route for field parent from  edit to show
//        $listMapper
//            ->addIdentifier('parent', null, array(
//                'route' => array('name' => 'show')
//            ));
        $listMapper
            ->addIdentifier('parent', null, array(
                'route' => array('name' => 'show')
            ))
            ->addIdentifier('name')
            ->add('pageTitle')
            ->add('shortDescription')
            ->add('description')
            ->add('price')
            ->add('productOrder')
            ->add('status');
    }
}