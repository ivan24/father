<?php
/**
 * @author Ivan Oreshkov ivan.oreshkov@itstartuplabs.com
 */

namespace Perga\AdminBundle\Controller;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductPriceAdmin extends Admin
{
    //set a custom URL for a given this class
    protected $baseRoutePattern = 'product/price';

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('product', null, array('label' => "Продукт"))
            ->add('value', null, array('label' => "Значение"))
            ->add('price', null, array('label' => "Цена"))
            ->add('currency', null, array('label' => "Валюта"))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product', null, array('label' => "Продукт"))
            ->add('currency', null, array('label' => "Валюта"))
        ;
    }
    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('product', null, array('label' => "Продукт"))
            ->addIdentifier('value', null, array('label' => "Значение"))
            ->addIdentifier('price', null, array('label' => "Цена"))
            ->addIdentifier('currency', null, array('label' => "Валюта"))
        ;
    }
}