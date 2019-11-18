<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{

    /**
     * Permet d'avoir la configuration de base d'un champ
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     */

    protected function getConfiguration($label, $placeholder)
    {
        return  [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("nom", "ajouter votre nom"))
            ->add('price', MoneyType::class, $this->getConfiguration("prix", "ajouter votre prix"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "ajouter une description"))
            ->add('brand', TextType::class, $this->getConfiguration("Marque", "marque su produit"))
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                "choice_label" => "name"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
