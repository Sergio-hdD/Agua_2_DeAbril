<?php

namespace App\Form;

use App\Entity\Pago;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroDeCuota', ChoiceType::class, [
                'label'=>'Selecione la cuota a la que pertenece el comprobante',
                'choices'  => [
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                    6 => 6,
                    7 => 7,
                    8 => 8,
                    9 => 9,
                    10 => 10,
                    11 => 11,
                    12 => 12
                ],
            ])        
            ->add('nombreDeComprobante', FileType::class, [
                'label'=>'Selecione el comprobante de Pago',
                'allow_file_upload'=>true,
                'by_reference'=>false,     
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([ 
                    'mimeTypesMessage' => "Tipo de archivo invalido, debe ser .PDF o una imagen"]
                )]
            ])
            ->add('numeroDeComprobante', null, ['label' => 'Ingrese el número de comprobante (opcional)'])
            ->add('importe', null, ['label' => 'Ingrese el importe (opcional)'])          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }
}
