<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 */

namespace Ambientia\DataCleanerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author mati.andreas@ambientia.ee
 */
class AmbientiaDataCleanerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = $this->createLoader($container);
        $loader->load('services.yaml');
    }

    private function createLoader(ContainerBuilder $container): YamlFileLoader
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        return $loader;
    }
}