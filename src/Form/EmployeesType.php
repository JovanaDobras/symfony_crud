<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Position;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'input'
                ]
            ])
            ->add('password', PasswordType::class, [
                'mapped' => true,
                'attr' => [
                    'class' => 'input'
                ],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{limit }} characters',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('salary', NumberType::class)

            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'inputForm'
                ],
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'choice_label' => 'position_name'
            ])

            ->add('save', SubmitType::class, ['label' => 'Add user']);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
