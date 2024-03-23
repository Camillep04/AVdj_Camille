<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\MarquePage;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\MotCles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\Type\MotClesType;



class MarquePageType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
            {
                $builder
                ->add('date_creation', DateType::class)
                ->add('url', TextType::class)
                ->add('commentaire', TextType::class)
                ->add('motCles', EntityType::class, [
                    'class' => MotCles::class, // Spécifiez la classe d'entité MotCles
                    'choice_label' => 'mot_cles', // ou tout autre attribut que vous souhaitez afficher dans la liste déroulante
                    'multiple' => true, 
                    'expanded' => true
                ])

                ->add('valider', SubmitType::class);
            }
                // Ici, on défini de manière explicite le « data_class »
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
            'data_class' => MarquePage::class,
        ]);
    }
}