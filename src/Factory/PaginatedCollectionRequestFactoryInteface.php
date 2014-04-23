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

use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequestInterface;

/**
 * The PaginatedCollection factory interface describe the method to implement in order to build PaginatedCollection
 * objects.
 *
 * @package AlphaLabs\Pagination\Factory
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
interface PaginatedCollectionRequestFactoryInterface
{
    /**
     * Build an instance of PaginatedCollection.
     *
     * Returns null if the current context does not contain any information about pagination settings.
     *
     * @return PaginatedCollectionRequestInterface|null
     */
    public function build();
}
