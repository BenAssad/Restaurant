<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [

            ])
            ->add('name', TextType::class, [

            ])
            ->add('lastname', TextType::class, [

            ])
            ->add('birthAt', DateType::class, [

            ])
            ->add('phoneNumber', NumberType::class, [

            ])
            // ->add('password')
            
        ;
        if ($options["avatar"]) 
        {
            $builder->add('avatar', FileType::class, [
                "label" => "Photo de profile",
                'required' => false,
                "data_class" => null,
                'attr' => [
                    'onchange' => 'loadFile(event)'
                ]
            ]);
        }elseif ($options['avatarEdit']) 
        {
            $builder->add('avatatUpdate', FileType::class, [
                "label" => "Photo de profile",
                "required" => false,
                "mapped" => false,
                'attr' => [
                    'onchange' => 'loadFile(event)'
                ]
            ]);
        }
        if ($options['sub']) {
            $builder->add('Enregistrer', SubmitType::class);
        }
       
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'avatar' => false,
            'sub' => false
        ]);
    }
}
