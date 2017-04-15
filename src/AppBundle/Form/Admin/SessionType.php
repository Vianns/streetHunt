<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('city');
        $builder->add('openAt');
        $builder->add('startAt');
        $builder->add('pictureFile', VichImageType::class, ['required' => false]);
        $builder->add('isOver');
        $builder->add('type');
    }

    public function getBlockPrefix()
    {
        return 'app_session_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
