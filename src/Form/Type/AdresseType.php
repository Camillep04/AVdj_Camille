<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Adresse;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Employe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class AdresseType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
            {
                $builder
                ->add('pays', TextType::class)
                ->add('ville', TextType::class)
                ->add('rue', TextType::class)
                ->add('codePostal', IntegerType::class);
            }
                // Ici, on défini de manière explicite le « data_class »
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}