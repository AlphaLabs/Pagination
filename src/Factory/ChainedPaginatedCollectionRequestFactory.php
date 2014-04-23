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
    private $factories = [];
    /** @var array */
    private $sorted = [];

    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $paginationInfo = null;

        /** @var PaginatedCollectionRequestFactoryInterface $factory */
        foreach ($this->getFactories() as $factory) {
            $paginationInfo = $factory->build();

            if (!is_null($paginationInfo)) {
                break;
            }
        }

        return $paginationInfo;
    }

    /**
     * Adds a factory in the factory chain
     *
     * @param PaginatedCollectionRequestFactoryInterface $factory
     * @param int                                        $priority
     */
    public function addFactory(PaginatedCollectionRequestFactoryInterface $factory, $priority = 0)
    {
        $this->factories[$priority][] = $factory;

        unset($this->sorted);
    }

    /**
     * Gets the sorted factories
     *
     * @return array
     */
    public function getFactories()
    {
        if (!isset($this->sorted)) {
            $this->sortFactories();
        }

        return $this->sorted;
    }

    /**
     * Sorts the internal list of factories by priority.
     */
    private function sortFactories()
    {
        $this->sorted = [];

        krsort($this->factories);
        $this->sorted = call_user_func_array('array_merge', $this->factories);
    }
}
