<?php declare(strict_types=1);

/*
 * This file is part of the Ambientia DataCleaner package.
 */

namespace Ambientia\DataCleanerBundle;

use Ambientia\DataCleaner\QueryProviderInterface;
use Ambientia\DataCleanerBundle\DependencyInjection\CompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author mati.andreas@ambientia.ee
 */
class AmbientiaDataCleanerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CompilerPass());
        $container->registerForAutoconfiguration(QueryProviderInterface::class)
            ->addTag('ambientia.data_cleaner_provider')
        ;
    }


}