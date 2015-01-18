<?php

namespace Acme\MeetingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserManType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', "hidden")
            ->add('email')
            ->add('password')
            ->add('FirstName')
            ->add('LastName')
            ->add('country')
            ->add('city')
            ->add('BirthDate')
            ->add('MaritalStatus')
            ->add('BodyType')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\MeetingBundle\Entity\UserMan'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form';
    }
}
