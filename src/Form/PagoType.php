<?php

namespace App\Form;

use App\Entity\Pago;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PagoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('comprobante', FileType::class, [
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pago::class,
        ]);
    }
}
