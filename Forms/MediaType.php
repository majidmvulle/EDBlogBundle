<?php
/**
 * Created by Eton Digital.
 * User: Vladimir Mladenovic (vladimir.mladenovic@etondigital.com)
 * Date: 23.6.15.
 * Time: 14.22
 */

namespace ED\BlogBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Regex;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','hidden')
            ->add('title', 'text', array(
                'mapped' => false,
                'label' => 'Name: ',
                'attr' => array(
                    'class' => 'form-control form-control--lg',
                    'placeholder' => 'Enter photo title',
                ),
                'constraints' => array(
                    new Regex(array(
                        'pattern' => '/^[A-Za-z0-9-_]+$/',
                        'match' => true,
                        'message' => 'Title should contain only letters, numbers and dashes.'
                    ))
                )

            ))
            ->add('extension', 'hidden', array(
                'mapped' => false
            ))
            ->add('description', 'textarea', array(
                'label' => 'Description: ',
                'required' => false,
                'attr' => array(
                    'class' => 'form-control form-control--lg',
                    'placeholder' => 'Enter caption',
                    'rows' => 2,
                )
            ))
            ->add('update', 'submit',array(
                'attr' => array(
                    'class' => 'btn btn-md btn-primary btn-wide--xl flright--responsive-mob margin--b'
                ))
            )
        ;

        $builder
            ->addEventListener(FormEvents::POST_SET_DATA, function($event){
                $media = $event->getData();
                $form = $event->getForm();

                $nameParts = explode('.', $media['name']);

                $form['title']->setData($nameParts[0]);
                $form['extension']->setData( isset($nameParts[1]) ? $nameParts[1] : '' );
            })
            ->addEventListener(FormEvents::PRE_SUBMIT, function($event){
                $form = $event->getForm();
                $fileName = $form['title']->getData() . '.' . $form['extension']->getData();

                $form['name']->setData( $fileName );

                if(substr_count($fileName, '.') != 1)
                {
                    $form['name']->addError(new FormError("Please check your file name"));
                }
            })
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver); // TODO: Change the autogenerated stub
    }

    public function getName()
    {
        return 'media_library_media';
    }

}