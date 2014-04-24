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

use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Build a PaginatedCollectionRequestInterface object based on the current request
 *
 * @package AlphaLabs\Pagination\Factory
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class RequestBasedPaginatedCollectionRequestFactory implements PaginatedCollectionRequestFactoryInterface
{
    /** @var RequestStack */
    protected $requestStack;
    /** @var string */
    protected $pageKey;
    /** @var string */
    protected $itemsPerPageKey;

    /**
     * @param RequestStack $requestStack
     * @param string       $itemsPerPageKey
     * @param string       $pageKey
     */
    public function __construct(RequestStack $requestStack, $itemsPerPageKey, $pageKey)
    {
        $this->itemsPerPageKey = $itemsPerPageKey;
        $this->pageKey         = $pageKey;
        $this->requestStack    = $requestStack;
    }

    /**
     * {@inheritDoc}
     */
    public function build(Request $request = null)
    {
        if (null === $request) {
            if (null === $request = $this->requestStack->getCurrentRequest()) {
                return null;
            }
        }

        $page         = $this->extractValue($request, $this->pageKey);
        $itemsPerPage = $this->extractValue($request, $this->itemsPerPageKey);

        if (is_null($page) && is_null($itemsPerPage)) {
            return null;
        }

        $paginationInfo = new PaginatedCollectionRequest();
        $paginationInfo->setPage($page);
        $paginationInfo->setItemsPerPage($itemsPerPage);

        return $paginationInfo;
    }

    /**
     * Extract from the request the value of the given key.
     * This method can be override in order to change the extraction logic.
     *
     * The method should return null if the key isn't found in the request.
     *
     * @param Request $request
     * @param string  $key
     *
     * @return mixed|null
     */
    protected function extractValue(Request $request, $key)
    {
        return $request->get($key);
    }
}
