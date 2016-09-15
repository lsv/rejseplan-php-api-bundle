<?php

namespace Lsv\RejseplanApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class LsvRejseplanApiExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->addDefinitions(array(
            'rejseplan_arrivalboard_service'     => $this->getArrivalboardService($config),
            'rejseplan_departureboard_service' => $this->getDepartureboardService($config),
            'rejseplan_journey_service'   => $this->getJourneyService($config),
            'rejseplan_location_service'   => $this->getLocationService($config),
            'rejseplan_nearbystops_service'   => $this->getNearbystopsService($config),
            'rejseplan_trip_service'   => $this->getTripService($config),
        ));
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getArrivalboardService($config)
    {
        $service = new Definition('RejseplanApi\Services\ArrivalBoard');
        $service->addArgument($config['baseurl']);
        return $service;
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getDepartureboardService($config)
    {
        $service = new Definition('RejseplanApi\Services\DepartureBoard');
        $service->addArgument($config['baseurl']);
        return $service;
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getJourneyService($config)
    {
        $service = new Definition('RejseplanApi\Services\Journey');
        $service->addArgument($config['baseurl']);
        return $service;
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getLocationService($config)
    {
        $service = new Definition('RejseplanApi\Services\Location');
        $service->addArgument($config['baseurl']);
        return $service;
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getNearbystopsService($config)
    {
        $service = new Definition('RejseplanApi\Services\NearbyStops');
        $service->addArgument($config['baseurl']);
        return $service;
    }

    /**
     * @param array $config
     * @return Definition
     */
    private function getTripService($config)
    {
        $service = new Definition('RejseplanApi\Services\Trip');
        $service->addArgument($config['baseurl']);
        return $service;
    }

}
