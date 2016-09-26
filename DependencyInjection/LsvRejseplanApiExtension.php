<?php

namespace Lsv\RejseplanApiBundle\DependencyInjection;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

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

        $client = $this->getClient($config);
        $container->addDefinitions(array(
            'rejseplan_arrivalboard_service'     => $this->getArrivalboardService($client, $config),
            'rejseplan_departureboard_service' => $this->getDepartureboardService($client, $config),
            'rejseplan_journey_service'   => $this->getJourneyService($client, $config),
            'rejseplan_location_service'   => $this->getLocationService($client, $config),
            'rejseplan_nearbystops_service'   => $this->getNearbystopsService($client, $config),
            'rejseplan_trip_service'   => $this->getTripService($client, $config),
        ));
    }

    /**
     * @param array $config
     * @return ClientInterface|null
     */
    private function getClient(array $config)
    {
        return $config['client'];
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getArrivalboardService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\ArrivalBoard');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getDepartureboardService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\DepartureBoard');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getJourneyService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\Journey');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getLocationService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\Location');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getNearbystopsService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\NearbyStops');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

    /**
     * @param ClientInterface $client
     * @param array $config
     * @return Definition
     */
    private function getTripService($client, $config)
    {
        $service = new Definition('RejseplanApi\Services\Trip');
        $service->addArgument($config['baseurl']);
        $service->addArgument($client);
        return $service;
    }

}
