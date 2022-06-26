<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['profile']) {
            $builder
            ->add('name', TextType::class, [
                "required" => false,
                'label' => 'Nom'
            ])
            ->add('lastname', TextType::class, [
                "required" => false,
                'label' => 'Prénom'
            ])
            ->add('email', EmailType::class, [
                "required" => false
            ])
            ->add('birthAt', DateType::class, [
                "required" => false,
                // "widget" => "choice",
                "widget" => "single_text",
                // 'input'  => 'datetime_immutable',
                'label' => 'Date de naissance',
                "attr" => [
                    "placeholder" => "Date de naissance",
                    // "placeholder" => "Select a value",
                ]
            ])
            ->add('phoneNumber', NumberType::class,[
                "required" => false,
                'label' => 'Téléphone'
            ])
            ;
        }
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
        if ($options["accepter"]) 
        {
                $builder->add('accepter', CheckboxType::class, [
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                            'message' => 'Accepter les conditions générales du site',
                        ]),
                    ],
                ])
                ;
        }
           
        
        if ($options["password"]) {
            
            $builder->add('plainPassword', RepeatedType::class, [
                        // instead of being set onto the object directly,
                        // this is read and encoded in the controller
                        'type' => PasswordType::class,
                        'invalid_message' => 'Les mots de passe ne sont pas identique',
                        'options' => ['attr' => ['class' => 'password-field']],
                        'required' => true,
                        'first_options'  => ['label' => 'Mot de passe'],
                        'second_options' => ['label' => 'Confirmer le Mot de passe'],
                        'mapped' => false,
                        'attr' => ['autocomplete' => 'new-password'],
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Veuillez renseigner un mot de passe',
                            ]),
                            new Length([
                                'min' => 6,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                        ],
                    ]);
            
           
        }
        if ($options['sub']) {
            $builder->add('Modifier', SubmitType::class);
        }
        
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            "profile" => false,
            "avatar" => false,
            "accepter" => false,
            "password" => false,
            "confirm" => false,
            "avatarEdit" => false,
            "sub" => false
        ]);
    }
}
