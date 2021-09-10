<?php
namespace App\Form;

use App\Entity\Article;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleFormType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('title', TextType::class)
        //     ->add('content')
        //     ->add('publishedAt', null, [
        //         'widget' => 'single_text'
        //     ])
        //     ->add('author')
        // ;
        // $builder->add('order_type', ChoiceType::class, [
        //     'required' => false,
        //     'multiple' => false,
        //     'choices' => [
        //         '0' => 'DESC',
        //         '1' => 'ASC',
        //     ],
        //     'attr' => [
        //         'class' => 'order-select'
        //     ],
        // ]);
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(), // Không được phép null.
                    new Length([
                        'min' => 5,
                        'max' => 20,
                    ]), // Phải có ít nhất 5 kí tự và không được vượt qúa 20 kí tự
                ],
            ])
            ->add('sort_no', NumberType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(), // Không được phép null.
                    new GreaterThan([
                        'value' => 0,
                    ]), // Phải lớn hơn 0.
                    new LessThanOrEqual([
                        'value' => 20,
                    ]), // Không được vượt quá 20.
                ],
            ])
            ->add('save', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}