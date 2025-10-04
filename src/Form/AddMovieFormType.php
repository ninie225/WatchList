<?php

namespace App\Form;

use App\Entity\Film;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddMovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
                'label' => 'Title',
                ]) 
        ->add('filmmaker', TextType::class, [
                'label' => 'Filmmaker',
                ])
        ->add('year', IntegerType::class, [
                'label' => 'Year',
                ])
        ->add('picture', FileType::class, [
                'label' => 'Poster', 
                'mapped' => false,
                 'constraints' => [
                    new NotBlank([
                        'message' => 'Please upload a poster',
                    ]),
                    new File(
                        maxSize: '1024k',
                        extensions: ['png', 'jpg', 'jpeg'],
                        extensionsMessage: 'Please upload a valid picture',
                    )
                ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
            "attr" => [ "novalidate" => "novalidate"]
        ]);
    }
}
