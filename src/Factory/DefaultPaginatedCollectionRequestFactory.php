<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\PaginatedCollection\Factory;

use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequest;
use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequestInterface;

/**
 * The default pagination factory provides the default pagination
 * (useful to provide a base pagination information if no pagination information is provided elsewhere).
 *
 * @package AlphaLabs\Pagination\PaginatedCollection\Factory
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class DefaultPaginatedCollectionRequestFactory implements PaginatedCollectionRequestFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function build()
    {
        $paginationInfo = new PaginatedCollectionRequest();
        $paginationInfo->setPage(1);

        return $paginationInfo;
    }
}
