<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\Pager;

use AlphaLabs\Pagination\Exception\InvalidRequestedPage;
use AlphaLabs\Pagination\PaginatedCollection\PaginatedCollectionRequestInterface;
use AlphaLabs\Pagination\PaginatedCollection\Provider\PaginatedCollectionRequestProviderInterface;
use Pagerfanta\Adapter\AdapterInterface;
use Pagerfanta\Exception\LessThan1CurrentPageException;
use Pagerfanta\Exception\OutOfRangeCurrentPageException;
use Pagerfanta\Pagerfanta;

/**
 * This trait can be used in business service or data providers in order to handle the pagination of a query result.
 *
 * @package AlphaLabs\Pagination\Pager
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
trait PagerTrait
{
    /** @var PaginatedCollectionRequestProviderInterface */
    protected $paginationInfoProvider;

    /**
     * Sets the PaginatedCollectionRequest provider
     *
     * @param PaginatedCollectionRequestProviderInterface $paginationInfoProvider
     *
     * @return $this
     */
    public function setPaginatedCollectionRequestProvider(
        PaginatedCollectionRequestProviderInterface $paginationInfoProvider
    ) {
        $this->paginationInfoProvider = $paginationInfoProvider;

        return $this;
    }

    /**
     * Build a Pagerfanta object based on the pagination information.
     *
     * The pagination information can be passed as a parameter, and if not the method use the injected provider to
     * extract pagination information based on the current context.
     *
     * @param \Pagerfanta\Adapter\AdapterInterface $adapter Wrapped query
     * @param PaginatedCollectionRequestInterface  $paginationInfo Requested pagination
     *
     * @return \PagerFanta\PagerFanta
     *
     * @throws \LogicException If no pagination could be used in order to paginate the results
     * @throws \AlphaLabs\Pagination\Exception\InvalidRequestedPage If the requested pagination could not be applied
     */
    public function paginate(AdapterInterface $adapter, PaginatedCollectionRequestInterface $paginationInfo = null)
    {
        if (is_null($paginationInfo)) {
            if (is_null($this->paginationInfoProvider)) {
                throw new \LogicException(
                    'A PaginatedCollectionRequestProviderInterface must be injected if you want to use pagination '.
                    'and don\t want to handle the pagination info with your own logic.'
                );
            }

            $paginationInfo = $this->paginationInfoProvider->getPaginatedCollectionRequest();

            if (is_null($paginationInfo)) {
                throw new \LogicException(
                    'No pagination could be provided by the PaginatedCollectionRequestProviderInterface. The provider '.
                    'must at least provide default pagination information in order to use the paginate() method.'
                );
            }
        }

        $pager = new Pagerfanta($adapter);

        try {
            $pager
                ->setMaxPerPage($paginationInfo->getItemsPerPage())
                ->setCurrentPage($paginationInfo->getPage());
        } catch (LessThan1CurrentPageException $e) {
            $invalidPageException = new InvalidRequestedPage();

            $invalidPageException
                ->setRequestedPage($paginationInfo->getPage())
                ->setTargetPage(1);

            throw $invalidPageException;
        } catch (OutOfRangeCurrentPageException $e) {
            $invalidPageException = new InvalidRequestedPage();

            $invalidPageException
                ->setRequestedPage($paginationInfo->getPage())
                ->setTargetPage($pager->getNbPages() - 1);

            throw $invalidPageException;
        }

        return $pager;
    }
}
