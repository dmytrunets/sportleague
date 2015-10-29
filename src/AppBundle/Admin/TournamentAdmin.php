<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournamentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title', 'text');
        $formMapper->add('startDate', 'datetime');
        $formMapper->add('finishDate', 'datetime');
        $formMapper->add('countPlayer', 'integer');
        $formMapper->add('gameTime', 'integer');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
        $datagridMapper->add('startDate');
        $datagridMapper->add('finishDate');
        $datagridMapper->add('countPlayer');
        $datagridMapper->add('gameTime');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
        $listMapper->addIdentifier('startDate');
        $listMapper->addIdentifier('finishDate');
        $listMapper->addIdentifier('countPlayer');
        $listMapper->addIdentifier('gameTime');
    }
} 
