<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $isRegistration = $options['is_registration'] ?? false;

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    'placeholder' => 'admin@example.com',
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    'placeholder' => 'Votre nom',
                ],
                'required' => $isRegistration,
            ]);

        if ($isRegistration) {
            $builder->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    ],
                ],
                'mapped' => false,
            ]);
        } else {
            $builder->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => [
                    'class' => 'w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500',
                    'placeholder' => '••••••••',
                ],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_registration' => false,
        ]);
    }
}
