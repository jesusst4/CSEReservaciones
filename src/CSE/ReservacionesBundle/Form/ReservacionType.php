<?php

namespace CSE\ReservacionesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('huesped', new HuespedType())
            ->add('codigo','text',array('attr'  => array('class'=>'txt'), 'label'=>'Código' ))
            ->add('cantPersonas','text',array('attr'  => array('class'=>'txt'), 'label'=>'N° de Personas' ))
            ->add('fechaIngreso','date',array('attr'  => array('label'=>'Fecha de Ingreso' )))
            ->add('fechaSalida','date',array('attr'  => array( 'label'=>'Fecha de Salida' )))
            ->add('habitacion','entity',array('attr' => array('class'=>'txt', 'placeholder'=>'Seleccione el tipo de habitación'),'class' => 'CSEReservacionesBundle:Habitacion'))
            ->add('totalReservacion','text',array('attr'  => array('class'=>'txt'), 'label'=>'Total' ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {        
        $resolver->setDefaults(array(
            'data_class' => 'CSE\ReservacionesBundle\Entity\Reservacion',
             'cascade_validation' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cse_reservacionesbundle_reservacion';
    }
}
