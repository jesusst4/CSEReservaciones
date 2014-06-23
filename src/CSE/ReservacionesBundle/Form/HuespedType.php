<?php

namespace CSE\ReservacionesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HuespedType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cedula','text',array('attr'  => array('class'=>'txt'), 'label'=>'Cédula' ))
            ->add('nombre','text',array('attr'  => array('class'=>'txt'), 'label'=>'Nombre' ))
            ->add('correo','text',array('attr'  => array('class'=>'txt'), 'label'=>'Correo' ))
            ->add('celular','text',array('attr'  => array('class'=>'txt'), 'label'=>'Celular' ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CSE\ReservacionesBundle\Entity\Huesped'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cse_reservacionesbundle_huesped';
    }
}
