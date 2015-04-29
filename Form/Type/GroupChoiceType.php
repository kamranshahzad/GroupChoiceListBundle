<?php



namespace Kamran\GroupChoiceListBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;
use Kamran\GroupChoiceListBundle\Form\DataTransformer\GroupChoiceListTransformer;



class GroupChoiceType extends AbstractType
{
    private $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        foreach($options['choice_list'] as $groupsArray){
            
            $listType = ($options['list_type'] == 'checkbox') ? array('multiple'=>true) : array();
            $defaultOptions = array_merge($listType , array('label'=>$groupsArray['group']['title'],'choice_list' => new SimpleChoiceList($groupsArray['options']) , 'expanded'=>true));
            $builder->add($groupsArray['group']['id'],'choice',$defaultOptions);
        }

        
        $transformer = new GroupChoiceListTransformer( $this->em , $options );
        $builder->addViewTransformer($transformer);

    }


    /**
    * {@inheritdoc}
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'choice_list' => array(),
                'entity_class' => '',
                'list_type'=> 'checkbox'
            ));
        $resolver->setRequired(array('choice_list'));
    }

    /**
    * {@inheritdoc}
    */
    public function getName()
    {
        return 'groupchoicelist';
    }

}