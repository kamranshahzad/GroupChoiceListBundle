<?php



namespace Kamran\GroupChoiceListBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;



class GroupChoiceListTransformer implements DataTransformerInterface
{
    
    private $em;
    private $choice_list;
    private $list_type;
    private $entity_class;

    public function __construct($entityManager, $options){
       
        $this->em = $entityManager;
        $this->choice_list  = $options['choice_list'] ;
        $this->entity_class = $options['entity_class'];
        $this->list_type = $options['list_type'];
    }

    //PersistentCollection 
	public function transform($objects)
    {

        if ($objects === null) {
            return '';
        }

        $checkedOptions = array();
        $booleanOptions  = array();

        foreach($objects->toArray() as $object){
            $checkedOptions[] = $object->getId();
        }

        if($checkedOptions){
            if($this->list_type == 'checkbox'){
                foreach($this->choice_list as $groupOptions){
                    $groupId = $groupOptions['group']['id'];
                    $options = $groupOptions['options'];
                    $booleanOptions[$groupId] = array();
                    foreach($options as $id=>$label){ 
                        $booleanOptions[$groupId][] = in_array($id,$checkedOptions) ? $id : '';
                    }
                }
            }else{
                foreach($this->choice_list as $groupOptions){
                    $groupId = $groupOptions['group']['id'];
                    $options = $groupOptions['options'];
                    foreach($options as $id=>$label){
                        if(in_array($id,$checkedOptions)){
                            $booleanOptions[$groupId] = $id;    
                        } 
                    }
                }
            }
        }

        return $booleanOptions;
    }

    // $values Array 
    public function reverseTransform($values)
    {

        if (!is_array($values)) {
                throw new UnexpectedTypeException($values, 'array');
        }
        $collection = new ArrayCollection();
            
        if($this->list_type == 'checkbox'){
            foreach($values as $groupid => $options){
                foreach($options as $index => $fieldId){
                    $collection->add($this->em->getRepository($this->entity_class)->find($fieldId));
                }
            }
        }else{
            foreach($values as $groupId => $fieldId){
                $collection->add($this->em->getRepository($this->entity_class)->find($fieldId));
            }
        }

        return $collection;
    }

}
