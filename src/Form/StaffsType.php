<?php

namespace App\Form;

use App\Entity\Organizations;
use App\Entity\Position;
use App\Entity\Staffs;
use App\Repository\OrganizationsRepository;
use App\Repository\PositionRepository;
use App\Repository\StaffsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaffsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone')
            ->add('email')
            ->add('organization', EntityType::class, [
                'class' => Organizations::class,
                'query_builder' => function(OrganizationsRepository $organization) {
                $qb = $organization->createQueryBuilder("ot");
                return $qb;
                },
                'choice_label' => 'name',
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'query_builder' => function(PositionRepository $position) {
                $qb = $position->createQueryBuilder("ot");
                return $qb;
                },
                'choice_label' => 'name',
            ])
            ->add('parent', EntityType::class, [
                'class' => Staffs::class,
                'query_builder' => function(StaffsRepository $staff) {
                    $qb = $staff->createQueryBuilder("ot");
                    return $qb;
                },
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Staffs::class,
        ]);
    }
}
