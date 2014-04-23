<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\Provider;

use AlphaLabs\Pagination\Factory\PaginatedCollectionRequestFactoryInterface;
use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequestInterface;

/**
 * The paginated collection request provider is able to provide a valid PaginatedCollectionRequestInterface object.
 * Before being validated, the PaginatedCollectionRequestInterface build operation is delegated to the injected factory.
 *
 * @package AlphaLabs\Pagination\Provider
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class PaginatedCollectionRequestProvider implements PaginatedCollectionRequestProviderInterface
{
    /** @var PaginatedCollectionRequestFactoryInterface Factory used to build pagination request */
    private $factory;
    /** @var int Default item per page setting */
    protected $defaultItemPerPageCount;

    /**
     * @param PaginatedCollectionRequestFactoryInterface $factory                 Factory used to build pagination request
     * @param int                                        $defaultItemPerPageCount Default item per page setting
     */
    public function __construct(PaginatedCollectionRequestFactoryInterface $factory, $defaultItemPerPageCount = 10)
    {
        $this->factory                 = $factory;
        $this->defaultItemPerPageCount = $defaultItemPerPageCount;
    }

    /**
     * {@inheritDoc}
     */
    public function getPaginatedCollectionRequest()
    {
        $paginationInfo = $this->factory->build();

        if (!is_null($paginationInfo)) {
            // Adds default items per page if no one is provided
            if (is_null($paginationInfo->getItemsPerPage())) {
                $paginationInfo->setItemsPerPage($this->defaultItemPerPageCount);
            }

            $this->validatePaginatedCollectionRequest($paginationInfo);
        }

        return $paginationInfo;
    }

    /**
     * Checks the pagination request validity
     *
     * @param PaginatedCollectionRequestInterface $paginationInfo
     *
     * @throws \InvalidArgumentException
     */
    private function validatePaginatedCollectionRequest(PaginatedCollectionRequestInterface $paginationInfo)
    {
        if (!(ctype_digit((string)$paginationInfo->getPage()) && 0 <= (int)$paginationInfo->getPage())) {
            throw new \InvalidArgumentException('Page must be a positive integer');
        }

        if (!(ctype_digit((string)$paginationInfo->getItemsPerPage()) && 0 <= (int)$paginationInfo->getItemsPerPage())) {
            throw new \InvalidArgumentException('Items per page must be a positive integer');
        }
    }
}
