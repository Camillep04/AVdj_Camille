<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Employe;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Adresse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\Type\AdresseType;



class EmployeType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
            {
                $builder
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('statut', TextType::class)
                ->add('adresse', AdresseType::class)
                // ->add('adresse', EntityType::class, [
                //     'class' => Adresse::class
                // ])
                ->add('valider', SubmitType::class);
            }
                // Ici, on défini de manière explicite le « data_class »
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}