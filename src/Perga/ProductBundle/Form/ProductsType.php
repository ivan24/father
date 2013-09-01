<?php

namespace Perga\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parent')
            ->add('name')
            ->add('pageTitle')
            ->add('shortDescription')
            ->add('description')
            ->add('price')
            ->add('productOrder')
            ->add('status');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Perga\ProductBundle\Entity\Products'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'perga_productbundle_productstype';
    }
}
