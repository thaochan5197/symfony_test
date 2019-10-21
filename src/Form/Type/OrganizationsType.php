<?php


namespace App\Form\Type;

use App\Entity\OrganizationType;
use App\Repository\OrganizationTypeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class OrganizationsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('type', EntityType::class, [
                "class" => OrganizationType::class,
                "query_builder" => function(OrganizationTypeRepository $type) {
                $qb = $type->createQueryBuilder("ot");
                return $qb;
                },
                "choice_label"=>"name"
            ])
            ->add('save', SubmitType::class, [
            ]);
    }
}