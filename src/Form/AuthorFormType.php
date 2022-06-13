<?php

namespace App\Form;

use App\Entity\Author;
use Doctrine\DBAL\Types\TextType as TypesTextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AuthorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'auteur", // 'label' => false si on ne veux pas afficher le label
                'required' => false,

                // Ajouter CSS ici pas ailleur
                'attr' => [
                    'class' => 'class1 css_over'
                ]                
            ])
            ->add('profileFile', VichImageType::class, [
                'imagine_pattern' => 'vignette', // Applique une configuration LiipImagine sur l'image
                'download_label' => false // Enlève le lien de téléchargement
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
