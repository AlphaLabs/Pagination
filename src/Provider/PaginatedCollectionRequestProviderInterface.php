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

use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequestInterface;

interface PaginatedCollectionRequestProviderInterface
{
    /**
     * Provide the current pagination request
     *
     * Returns null if the current context does not provide any pagination information.
     *
     * @return PaginatedCollectionRequestInterface|null
     */
    public function getPaginatedCollectionRequest();
}
