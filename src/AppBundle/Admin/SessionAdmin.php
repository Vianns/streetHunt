<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SessionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('city');
        $formMapper->add('name');
        $formMapper->add('openAt');
        $formMapper->add('startAt');
        $formMapper->add('type');

        $container = $this->getConfigurationPool()->getContainer();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('city');
        $datagridMapper->add('name');
        $datagridMapper->add('openAt');
        $datagridMapper->add('startAt');
        $datagridMapper->add('type');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('city');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('type');
    }
}
