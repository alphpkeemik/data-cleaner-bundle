<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\DataCleanerBundle\Tests\DependencyInjection;

use Ambientia\DataCleaner\ObjectNormalizer;
use Ambientia\DataCleanerBundle\DependencyInjection\CompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * @author mati.andreas@ambientia.ee
 */
class CompilerPassTest extends TestCase
{
    public function testSerializer(): void
    {


        $container = $this->createMock(ContainerBuilder::class);

        $definition = $this->createMock(Definition::class);

        $container
            ->expects($this->once())
            ->method('findDefinition')
            ->with(
                'serializer.normalizer.object'
            )->willReturn($definition);

        $definition
            ->expects($this->once())
            ->method('setClass')
            ->with(
                ObjectNormalizer::class
            );

        $compilerPass = new CompilerPass();
        $compilerPass->process($container);
    }
}