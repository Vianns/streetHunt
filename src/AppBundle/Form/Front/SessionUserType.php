<?php

namespace AppBundle\Form\Front;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SessionUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('email');
        $builder->remove('username');
        $builder->remove('current_password');
        $builder->add('pictureFile', VichImageType::class, ['required' => false]);

        $builder->add('sex', ChoiceType::class, [
            'choices' => array_flip(User::getSexs()),
            'placeholder' => 'sex',
        ]);

        $builder->add('birthday', DateType::class, [
            'format' => 'dd MM yyyy',
            'years' => range(1900, 2020),
        ]);

        $builder->add('phoneNumber');
        $builder->add('transports', TextareaType::class);

        $builder->add('firstName');
        $builder->add('lastName');
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
