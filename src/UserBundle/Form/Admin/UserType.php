<?php

namespace UserBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Entity\User;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName');
        $builder->add('lastName');
        $builder->add('avatarFile', VichImageType::class, ['required' => false]);
        $builder->add('pictureFile', VichImageType::class, ['required' => false]);
        $builder->add('phoneNumber');
        $builder->add('transports', TextareaType::class);
        $builder->add('enabled');
        $builder->add('pictureValidated');
        $builder->add('civilResponsability');
        $builder->remove('current_password');

        $builder->add('birthday', DateType::class, [
            'format' => 'dd-MM-yyyy',
            'years' => range(date('Y') - 100, date('Y')),
        ]);

        $sexChoices = [
            'M' => 'M',
            'F' => 'F',
            'autre' => 'autre',
        ];

        $builder->add('sex', ChoiceType::class, [
            'choices' => array_flip($sexChoices),
            'choices_as_values' => true,
            'multiple' => false,
            'required' => false,
            'choice_attr' => function ($val) {
                return ['data-value' => $val];
            },
        ]);

        $builder->add('roles', ChoiceType::class, [
            'choices' => array_flip(User::getPossibleRoles()),
            'choices_as_values' => true,
            'multiple' => true,
            'required' => false,
            'choice_attr' => function ($val) {
                return ['data-value' => $val];
            },
        ]);

        $builder->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => false,
            'first_options' => ['label' => 'form.password', 'required' => false],
            'second_options' => ['label' => 'form.password_confirmation', 'required' => false],
        ]);
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
