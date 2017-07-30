<?php

/*
 * This file is part of the DoubleBitAPIPlatformMongoDBBundle package.
 *
 * (c) Andrew Meshchanchuk <andrew.meshchanchuk@gmail.com>
 * (c) Vasile Goian <opensource@doublebit.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoubleBit\APIPlatform\MongoDBBundle\Doctrine\Odm;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ODM\MongoDB\Cursor;
use DoubleBit\APIPlatform\MongoDBBundle\Doctrine\Odm\Filter\FilterInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use Dunglas\ApiBundle\Api\ResourceInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Data provider for the Doctrine ODM.
 *
 * @author Andrew Meshchanchuk <andrew.meshchanchuk@gmail.com>
 */
class ItemDataProvider implements ItemDataProviderInterface
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;
    /**
     * @var string|null
     */
    private $order;
    /**
     * @var string
     */
    private $pageParameter;
    /**
     * @var int
     */
    private $itemsPerPage;
    /**
     * @var bool
     */
    private $enableClientRequestItemsPerPage;
    /**
     * @var string
     */
    private $itemsPerPageParameter;

    /**
     * @param ManagerRegistry $managerRegistry
     * @param string|null     $order
     * @param string          $pageParameter
     * @param int             $itemsPerPage
     * @param bool            $enableClientRequestItemsPerPage
     * @param string          $itemsPerPageParameter
     */
    public function __construct(
        ManagerRegistry $managerRegistry,
        $order,
        $pageParameter,
        $itemsPerPage,
        $enableClientRequestItemsPerPage,
        $itemsPerPageParameter
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->order = $order;
        $this->pageParameter = $pageParameter;
        $this->itemsPerPage = $itemsPerPage;
        $this->enableClientRequestItemsPerPage = $enableClientRequestItemsPerPage;
        $this->itemsPerPageParameter = $itemsPerPageParameter;
    }

    /**
     * {@inheritdoc}
     */
    public function getItem(ResourceInterface $resource, $id, $fetchData = false)
    {
        $entityClass = $resource->getEntityClass();
        $manager = $this->managerRegistry->getManagerForClass($entityClass);

        if ($fetchData || !method_exists($manager, 'getReference')) {
            return $manager->find($entityClass, $id);
        }

        return $manager->getReference($entityClass, $id);
    }

}
