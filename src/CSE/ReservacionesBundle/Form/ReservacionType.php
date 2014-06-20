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
            ->add('codigo')
            ->add('cantPersonas')
            ->add('fechaIngreso')
            ->add('fechaSalida')
            ->add('totalReservacion')
            ->add('subtotalServicios')
            ->add('subtotalActividades')
            ->add('habitacion')
            ->add('huesped')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CSE\ReservacionesBundle\Entity\Reservacion'
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
