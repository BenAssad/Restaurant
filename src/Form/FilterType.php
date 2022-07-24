<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Filter\ProduitFilter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('categorie', EntityType::class, [
                "class" => Categorie::class,
                "choice_label" => "name",
                "multiple" => true,
                "expanded" => true,
                "required" => false
                ])
                ->add('recherche', TextType::class, [
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProduitFilter::class,
        ]);
    }
}
 