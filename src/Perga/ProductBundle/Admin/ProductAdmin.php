<?php

namespace Perga\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('parent', 'entity', array('class' =>'Perga\ProductBundle\Entity\Products'))
            ->add('name')
            ->add('pageTitle')
            ->add('shortDescription')
            ->add('description')
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
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('parent')
            ->add('name')
            ->add('pageTitle')
            ->add('shortDescription')
            ->add('description')
            ->add('price')
            ->add('productOrder')
            ->add('status');
        ;
    }
}