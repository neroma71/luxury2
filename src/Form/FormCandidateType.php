<?php

namespace App\Form;

use App\Entity\Candidate;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormCandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender', ChoiceType::class,[
                'choices'  => [
                    'Choose an option' => 'Chooseanoption',
                    'male' => 'male',
                    'female' => 'female',
                    'transgender' => 'transgender'
                ],
                'label' => 'Gender',
                'label_attr' => [
                    'class' => 'active',
                ]
            ])
            ->add('firstName', TextType::class,[
                'label' => 'First name'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last name'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adress'
            ])
            ->add('country', TextType::class, [
                'label' => 'Country'
            ])
            ->add('nationality', TextType::class, [
                'label' => 'Nationality'
            ])
            ->add('isPassportValid', ChoiceType::class, [
                'choices'  => [
                    'yes' => 'yes',
                    'no' => 'no',
                ],
                'label' => 'Valide passport',
                'label_attr' => [
                    'class' => 'active',
                ]
            ])
            ->add('dateBirth', TextType::class,[
                'label' => 'Date Birth'
            ])
            ->add('placeBirth', TextType::class, [
               'label' => 'Place birth' 
            ])
            ->add('isAvailable', ChoiceType::class, [
                'choices'  => [
                    'yes' => 'yes',
                    'no' => 'no',
                ],
                'label' => 'Is avaible',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('jobCategory', ChoiceType::class, [
                'choices'  => [
                    'informatique' => 'informatique',
                    'tertiary' => 'tertiary',
                    'building' => 'building'
                ],
                'label' => 'Interest in job category',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('experience', ChoiceType::class, [
                'choices'  => [
                    '0-6-month' => '0-6-month',
                    '6-month-1years' => '6-month-1years',
                    '1-2-years' => '1-2-years',
                ],
                'label' => 'Interest in job category',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'short description'
            ])
            ->add('profilPicture', FileType::class,[
                'label' => 'Porfile picture'
            ] )
            ->add('passport', FileType::class)
            ->add('cv', FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}