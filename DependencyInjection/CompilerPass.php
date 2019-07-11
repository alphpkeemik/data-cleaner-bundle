<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 *
 * (c) Ambientia Estonia OÜ
 */

namespace Ambientia\DataCleanerBundle\DependencyInjection;

use Ambientia\DataCleaner\ObjectNormalizer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $container
            ->findDefinition('serializer.normalizer.object')
            ->setClass(ObjectNormalizer::class);
    }
}
