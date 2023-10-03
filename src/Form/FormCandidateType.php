<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormCandidateType extends AbstractType
{

    public const IMAGES_BASE_PATH = 'asset/uploads/';
    public const IMAGES_BASE_DIR =  'public/asset/uploads/';

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
            ->add('dateBirth', DateType::class,[
                'label' => 'Date Birth',
                'label_attr' => [
                    'class' => 'active',
                ]
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
                'label' => 'Valide CV',
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
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'size' => 20000000,
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                ]
            ])
            ->add('passport', FileType::class,[
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'size' => 20000000,
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                ]
            ])
            ->add('cv', FileType::class,[
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'size' => 20000000,
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
