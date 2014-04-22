<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\PaginatedCollection;

/**
 * The paginated collection request interface describe the methods which should be implemented in classes
 * which are designed to contain all information related to pagination information.
 *
 * @package AlphaLabs\Pagination\PaginatedCollection
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
interface PaginatedCollectionRequestInterface
{
    /**
     * Gets the requested page number
     *
     * @return int
     */
    public function getPage();

    /**
     * Gets the requested item per page count
     *
     * @return int
     */
    public function getItemsPerPage();

    /**
     * Sets the itemsPerPage attribute
     *
     * @param int $itemsPerPage
     *
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage);

    /**
     * Sets the page attribute
     *
     * @param int $page
     *
     * @return $this
     */
    public function setPage($page);
}
