<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\DataCleanerBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\MonologBundle\DependencyInjection\Configuration;
use Symfony\Bundle\MonologBundle\DependencyInjection\MonologExtension;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author mati.andreas@ambientia.ee
 */
class ExtensionMonologTest extends TestCase
{

    public function testMonolog(): void
    {
        $expected = [
            [
                'handlers' => [
                    'data-cleaner' => [
                        'type' => 'rotating_file',
                        'path' => "%kernel.logs_dir%/data-cleaner.log",
                        'channels' => 'data-cleaner'
                    ]
                ]
            ]
        ];


        $container = new ContainerBuilder();
        $container->registerExtension(new MonologExtension());
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../Resources/config'));
        $loader->load('monolog.yaml');
        $processor = new Processor();
        $processor->process((new Configuration())->getConfigTreeBuilder()->buildTree(), []);
        $configs = $container->getExtensionConfig('monolog');
        $this->assertSame($configs, $expected);

    }

}