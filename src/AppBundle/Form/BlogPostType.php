<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class BlogPostType
 *
 * @package AppBundle\Form
 */
class BlogPostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank(['message' => 'To pole jest wymagane']),
                new Length([
                    'min' => 10,
                    'minMessage' => 'Tytuł musi zawierać co najmniej 10 znaków'
                ])
            ]
        ]);

        $builder->add('author', TextType::class, [
            'required' => true,
            'constraints' => [
                new NotBlank(['message' => 'To pole jest wymagane']),
                new Length([
                    'min' => 5,
                    'minMessage' => 'Autor musi zawierać co najmniej 5 znaków'
                ])
            ]
        ]);

        $builder->add('content', TextareaType::class, [
            'required' => true
        ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\BlogPost',
            'allow_extra_fields' => true,
            'csrf_protection' => false
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return null;
    }


}
