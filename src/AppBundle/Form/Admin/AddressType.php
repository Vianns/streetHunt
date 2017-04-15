<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('city');
        $builder->add('postalCode');
        $builder->add('firstField', TextareaType::class, ['required' => true]);
        $builder->add('secondField', TextareaType::class, ['required' => false]);
        $builder->add('name');
    }

    public function getBlockPrefix()
    {
        return 'app_address_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
