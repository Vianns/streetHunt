<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SessionUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('session');
        $builder->add('user');
        $builder->add('code');
        $builder->add('target');
        $builder->add('killedBy');
        $builder->add('status');
    }

    public function getBlockPrefix()
    {
        return 'app_session_user_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
