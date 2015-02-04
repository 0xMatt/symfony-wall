<?php
namespace Matthew\WallPostBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WallPostType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', [
            'label' => 'Title'
        ])
            ->add('author', 'text', [
            'label' => 'Author',
            'required' => false
        ])
            ->add('body', 'textarea', [
            'label' => 'Message',
            'attr' => [
                'id' => 'body'
            ]
        ])
            ->add('save', 'submit');
    }

    public function getName()
    {
        return 'wallpost';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Matthew\WallPostBundle\Entity\WallPost'
        ));
    }
}