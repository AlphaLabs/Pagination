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
 * The paginated collection request contains all information related to pagination information.
 *
 * @package AlphaLabs\Pagination\PaginatedCollection
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class PaginatedCollectionRequest implements PaginatedCollectionRequestInterface
{
    /** @var int */
    protected $page;
    /** @var int */
    protected $itemsPerPage;

    /**
     * {@inheritDoc}
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * {@inheritDoc}
     */
    public function getItemsPerPage()
    {
        return $this->itemsPerPage;
    }

    /**
     * {@inheritDoc}
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }
}
