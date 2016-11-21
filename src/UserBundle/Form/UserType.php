<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('email');
        $builder->remove('username');
        $builder->remove('current_password');
        $builder->add('avatarFile', VichImageType::class, ['required' => false]);
        $builder->add('pictureFile', VichImageType::class, ['required' => false]);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
