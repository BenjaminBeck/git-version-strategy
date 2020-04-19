<?php

namespace Emileperron\GitVersionStrategyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class EmileperronGitVersionStrategyExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['FrameworkBundle'])) {
            $config = [
                'assets' => [
                    'version_strategy' => 'Emileperron\\GitVersionStrategyBundle\\Asset\\GitVersionStrategy'
                ]
            ];
            $container->prependExtensionConfig('framework', $config);
        }
    }
}
