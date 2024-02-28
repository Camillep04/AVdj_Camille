<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Livre;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class LivreType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
            {
                $builder
                ->add('date', DateType::class)
                ->add('titre', TextType::class)
                ->add('page', IntegerType::class)
                ->add('valider', SubmitType::class);
            }
                // Ici, on défini de manière explicite le « data_class »
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}