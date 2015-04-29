<?php

namespace Kamran\GroupChoiceListBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;


class KamranGroupChoiceListExtension extends Extension
{

    public function getAlias()
    {
        return 'kamran_group_choice_list';
    }

    public function load(array $configs, ContainerBuilder $container)
    {
    	$processor = new Processor();
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

       /*$container->setParameter('twig.form.resources', array_merge(
            $container->getParameter('twig.form.resources'),
            array('KamranGroupChoiceListBundle:Form:choicegroup_widget.html.twig')
        ));*/
    }

}
