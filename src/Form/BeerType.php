<?php

namespace App\Form;

use App\Entity\Beer;
use App\Entity\Supplier;
use App\Entity\TypeBeer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BeerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [new NotBlank()]])
            ->add('description', TextType::class, [
                'constraints' => [new NotBlank()]])
            ->add('supplier', EntityType::class, [
                    'class' => Supplier::class,
                    'choice_name' => 'id',
                    'multiple' => true,
                    'constraints' => [new NotBlank()]])
            ->add('type', EntityType::class, [
                    'class' => TypeBeer::class,
                    'choice_name' => 'id',
                    'constraints' => [new NotBlank()]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beer::class,
        ]);
    }
}
