<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Register;
use App\Entity\Subscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

class RegisterType extends AbstractType
{
    public function __construct(private readonly Environment $twig)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('fullName', TextType::class)
            ->add('phone', TextType::class)
            ->add('identity', TextType::class)
            ->add('subscription', EntityType::class, [
                'class' => Subscription::class,
                'expanded' => true,
                'multiple' => false,
                'label_html' => true,
                'choice_label' => function (Subscription $subscription) {
                    return $this->getLabelHtml($subscription);
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Register::class,
        ]);
    }

    private function getLabelHtml(Subscription $subscription): string
    {
        return $this->twig->render(
            'subscription/partials/_card_subscription.html.twig',
            ['subscription' => $subscription]
        );
    }
}