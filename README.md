# group-choice-list-bundle

## Description

This bundle provides the group choice list form field

![alt text](https://github.com/kamranshahzad/GroupChoiceListBundle/blob/master/Resources/public/images/group_choice_list_screenshot.png "GroupChoiceList screenshot")


## Installation.

Using composer

``` bash
$ composer require kamran/groupchoicelist-bundle dev-master
```
Add the GroupChoiceListBundle to your AppKernel.php file:

```
new Kamran\GroupChoiceListBundle\KamranGroupChoiceListBundle();
```

## How to use?

GroupChoiceList provides a form type that show the multiple choices in group format. You may use in your form 'groupchoicelist' type.
``` php
	// form_file.php
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add group_choice_list as a form type in your form 
    	$builder->add('tags','groupchoicelist',array(
            'label'=>'Tags',
            'choice_list' => $this->em->getRepository('KamranTagsBundle:Tags')->findByGroup(),
            'entity_class' => 'KamranTagsBundle:Tags'
        ));
	}
	// entity_repository.php
	public function findByGroup(){
        $result = $this->createQueryBuilder('t')
            ->select('t , tt ')
            ->leftJoin('t.type', 'tt')->orderBy('t.type')
            ->getQuery()->getResult();
        $groupOptionsArray = array();
        $groupInfoArray = array();
        $groupArray = array();
        foreach($result as $object){
            $groupOptionsArray[$object->getType()->getId()][$object->getId()] = $object->getName();
            $groupInfoArray[$object->getType()->getId()] = array('id'=>$object->getType()->getId(),'title'=>$object->getType()->getName());
        }

        foreach($groupOptionsArray as $id=>$optionsArray){
            $groupArray[] = array('group'=>$groupInfoArray[$id],
                'options' => $optionsArray
            );
        }
        return $groupArray;
    }
```

## Reporting an issue or feature request.

Issues and feature requests are tracked in the 
[Github issue tracker](https://github.com/kamranshahzad/GroupChoiceListBundle/issues).


How to contribute?
------------------------------------
The contribution for this bundle for public is open, anybody could help me to participate 
bugs, documentation and code.



## License.
This software is licensed under the MIT license. See the complete license file in the bundle:
```
Resources/meta/LICENSE
```
[Read the License](https://github.com/kamranshahzad/GroupChoiceListBundle/blob/master/Resources/meta/LICENSE)
