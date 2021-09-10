<?php
namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder
        ->add('name', TextType::class, [
            'required' => false,
            'constraints' => [
                new NotBlank(),
//                new Length([
//                    'min' => 5,
//                    'max' => 30,
//                ])
            ]
        ])
        ->add('content', TextType::class, [
            'required' => false,
            'constraints' => [
                new NotBlank(),
//                new Length([
//                    'min' => 5,
//                    'max' => 100,
//                ])
            ]
        ])
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class
        ]);
    }
}
