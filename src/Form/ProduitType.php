<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required' => false,
                'label' => 'Titre'
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
                'label' => 'Description'
            ])
            ->add('prix', MoneyType::class, [
                'currency' => 'euro',
                'required' => false,
                'label' => 'Prix'
            ])
            ->add('categorie', EntityType::class, [
                "class" => Categorie::class ,
                'choice_label' => 'name',
                'placeholder' => 'Veuillez Saisir la Categorie',
                'required' => false
            ])
            ;
            if ($options['image']) {
               $builder
                    ->add('image', FileType::class, [
                        'required' => false,
                        'attr' => [
                            'onchange' => 'loadFile(event)'
                        ]
                    ]);
            }elseif ($options['imageUpdate']) {
                $builder
                    ->add('imageUpdate', FileType::class, [
                        'required' => false,
                        'mapped' => false,
                        'attr' => [
                            'onchange' => 'loadFile(event)'
                        ]
                    ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
            'image' => false,
            'imageUpdate' => false
        ]);
    }
}
