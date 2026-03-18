<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Ex: iPhone 15 Pro',
                    'class' => 'form-control'
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'attr' => [
                    'placeholder' => 'Ex: iphone-15-pro',
                    'class' => 'form-control'
                ],
                'help' => 'Utilisé dans les URLs',
                'required' => false
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix (€)',
                'attr' => [
                    'placeholder' => '0.00',
                    'class' => 'form-control',
                    'step' => '0.01',
                    'min' => 0
                ],
                'scale' => 2,
                'help' => 'Prix en euros avec 2 décimales'
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité en stock',
                'attr' => [
                    'placeholder' => '0',
                    'class' => 'form-control',
                    'min' => 0
                ],
                'help' => 'Quantité disponible en stock'
            ])
            ->add('category', CategoryAutocompleteField::class, [
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Choisir une catégorie',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description du produit...',
                    'class' => 'form-control',
                    'rows' => 5
                ],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
