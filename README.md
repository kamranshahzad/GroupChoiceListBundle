# group-choice-list-bundle

## Description

This bundle provides the group choice list(options) custom form type.

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
            'choice_list' => $data_array,
            'entity_class' => 'KamranTagsBundle:Tags'
        ));
	}
```
    * `choice_list` : This takes array data in proper format which is given below.
    * `entity_class`: Set entity class
    * `list_type`:    'checkbox' for group of checkboxes (default), 'radiobutton' for group of radiobuttons

``` php
    // data array format for 'choice_list' option
    $data_array = array(
        array(
            'group'   => array('id'=>1,'title'=>'PHP'),
            'options' => array(1=>'Symfony',2=>'Laravel',3=>'Wordpress',4=>'Magento',5=>'Drupal')
        ),
        array(
            'group'   => array('id'=>2,'title'=>'Javascript'),
            'options' => array(6=>'JQuery',7=>'NodeJS',8=>'BackboneJS',9=>'AngularJS',10=>'UnderscoreJS')
        ),
        array(
            'group'   => array('id'=>3,'title'=>'Python'),
            'options' => array(11=>'Django',12=>'Flask')
        ),
    );
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
