<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\DataCleanerBundle\Tests\DependencyInjection;

use Ambientia\DataCleaner\DataCleaner;
use Ambientia\DataCleaner\DataCleanerCommand;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author mati.andreas@ambientia.ee
 */
class ExtensionServicesTest extends AbstractContainerBuilderTestCase
{

    private function loadConfiguration(): void
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . '/../../Resources/config'));
        $loader->load('services.yaml');
    }

    public function testServiceDataCleaner(): void
    {
        $this->loadConfiguration();
        $this->assertContainerBuilderHasService(
            DataCleaner::class,
            null
        );
        $index = 0;
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            DataCleaner::class,
            $index++,
            new Reference('doctrine')
        );
        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            DataCleaner::class,
            $index++,
            new Reference('serializer')
        );

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            DataCleaner::class,
            $index++,
            new TaggedIteratorArgument('ambientia.data_cleaner_provider')
        );

        $this->assertContainerBuilderHasServiceDefinitionWithArgument(
            DataCleaner::class,
            $index++,
            new Reference('logger')
        );

        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            DataCleaner::class,
            'monolog.logger', [
                'channel' => 'data-cleaner'
            ]
        );

    }

    public function testServiceCommand(): void
    {
        $this->loadConfiguration();
        $this->assertContainerBuilderHasService(
            DataCleanerCommand::class,
            null
        );


        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            DataCleanerCommand::class,
            'setDataCleaner',
            [
                new Reference(DataCleaner::class)
            ]
        );

        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            DataCleanerCommand::class,
            'console.command'
        );

    }


}