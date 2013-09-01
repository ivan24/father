<?php

namespace Perga\ProductBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
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

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
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