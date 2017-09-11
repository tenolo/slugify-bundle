<?php

namespace Tenolo\Bundle\SlugifyBundle\Form\Type\Widgets;

use Cocur\Slugify\SlugifyInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class SlugifyType
 *
 * @package Tenolo\Bundle\SlugifyBundle\Form\Type\Widgets
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class SlugifyType extends AbstractType
{

    /** @var SlugifyInterface */
    protected $slugify;

    /**
     * @param SlugifyInterface $slugify
     */
    public function __construct(SlugifyInterface $slugify)
    {
        $this->slugify = $slugify;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('custom_slug', CheckboxType::class, [
            'label' => 'Eigenen Slug verwenden.',
            'attr'  => [
                'help_text'         => 'Wollen Sie einen eigenen Slug verwenden, müssen Sie diese Option aktivieren. Ansonsten wird dieser aus definierten Daten automatisch generiert.',
                'align_with_widget' => true
            ]
        ]);

        $builder->add('slug', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'groups' => [
                        'custom_slug'
                    ]
                ])
            ],
            'attr'        => [
                'help_text' => 'Der Slug wird nachträglich noch einmal bereinigt und sollte einmalig sein.',
            ],
        ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmit']);
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();

        if (isset($data['custom_slug'], $data['slug'])) {
            $data['slug'] = $this->slugify->slugify($data['slug']);
            $event->setData($data);
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label'             => false,
            'inherit_data'      => true,
            'validation_groups' => function (FormInterface $form) {
                $customSlug = $form->get('custom_slug')->getData();

                $groups = [
                    'Default'
                ];

                if ($customSlug) {
                    $groups[] = 'custom_slug';
                }

                return $groups;
            },
        ]);
    }

}
