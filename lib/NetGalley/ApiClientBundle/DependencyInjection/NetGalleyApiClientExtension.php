<?php

namespace NetGalley\ApiClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Load the NetGalleyApiClientBundle configuration.
 */
class NetGalleyApiClientExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Set each bundle configuration value as a container parameter
        array_walk(
            $config,
            array($this, 'setParameters'),
            array('parentKey' => $this->getAlias(), 'container' => $container)
        );

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('config.yml');
        $loader->load('services.yml');
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias(): string
    {
        return 'net_galley_api_client';
    }

    /**
     * Set all the configuration values as parameters, recursively.
     *
     * @param array|string $config
     * @param string $key
     * @param array $params
     */
    public function setParameters($config, $key, $params)
    {
        // Set the parameter name by appending the current key to the parent
        $parameterName = $params['parentKey'] . '.' . $key;

        // Set the container parameter
        $params['container']->setParameter($parameterName, $config);

        // If the config is an array, recursively call this function for each array value
        if (is_array($config)) {
            array_walk(
                $config,
                array($this, 'setParameters'),
                array('parentKey' => $parameterName, 'container' => $params['container'])
            );
        }
    }
}
