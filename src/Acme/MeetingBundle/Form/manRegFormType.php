<?php

namespace Acme\MeetingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class manRegFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('gender', 'hidden')
            ->add('email', 'text')
            ->add('password', 'text')
            ->add('FirstName', 'text')
            ->add('LastName', 'text')
            ->add('country', 'text')
            ->add('city', 'text')
            ->add('BirthDate', 'date')
            ->add('MaritalStatus', 'choice', array(
                'choices' => array('married' => 'married', 'not married' => 'not married'),
                'required' => true,
            ))
            ->add('BodyType', 'text')
            ->add('file', 'file')
        ;
    }

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