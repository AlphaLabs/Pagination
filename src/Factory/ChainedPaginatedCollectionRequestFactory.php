<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\Factory;

/**
 * This factory can delegate the build operation to a chain of other factories.
 * The first factory capable to build a pagination information object is used.
 *
 * @package AlphaLabs\Pagination\Factory
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class ChainedPaginatedCollectionRequestFactory implements PaginatedCollectionRequestFactoryInterface
{
    /** @var array */
    private $factories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->factories = [];
    }

    /**
     * Adds a factory in the factory chain
     *
     * @param PaginatedCollectionRequestFactoryInterface $factory
     */
    public function addFactory(PaginatedCollectionRequestFactoryInterface $factory)
    {
        $this->factories[] = $factory;
    }

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $paginationInfo = null;

        /** @var PaginatedCollectionRequestFactoryInterface $factory */
        foreach ($this->factories as $factory) {
            $paginationInfo = $factory->build();

            if (!is_null($paginationInfo)) {
                break;
            }
        }

        return $paginationInfo;
    }
}
