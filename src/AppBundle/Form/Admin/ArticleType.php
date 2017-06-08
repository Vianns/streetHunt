<?php

namespace AppBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('content');
    }

    public function getBlockPrefix()
    {
        return 'app_article_edit';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
