<?php

namespace BaseLine\Bundle\MiniBlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
class MinipostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('content', TextareaType::class, array('attr' => array('class' => 'form-control')))
            
            ->add('category', null, array('attr' => array('class' => 'form-control')))
            ->add('user', null, array('attr' => array('class' => 'form-control')))
            ->add('submit', SubmitType::class, array('attr'=>array("class" => 'btn btn-primary'), 'label'=>'Crear'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BaseLine\Bundle\MiniBlogBundle\Entity\Minipost'
        ));
    }
}
