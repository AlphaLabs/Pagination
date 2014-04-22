<?php
/*
 * This file licensed under the MIT license.
 *
 * (c) Sylvain Mauduit <swop@swop.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AlphaLabs\Pagination\Exception;

/**
 * Exception raised if the pagination request could not be fulfil based on the result set.
 *
 * @package AlphaLabs\Pagination\Exception
 *
 * @author  Sylvain Mauduit <swop@swop.io>
 */
class InvalidRequestedPage extends \RuntimeException
{
    /** @var  int */
    protected $targetPage;
    /** @var  int */
    protected $requestedPage;

    /**
     * Sets the original requested page
     *
     * @param int $requestedPage
     *
     * @return $this
     */
    public function setRequestedPage($requestedPage)
    {
        $this->requestedPage = $requestedPage;

        return $this;
    }

    /**
     * Gets the original requested page
     *
     * @return int
     */
    public function getRequestedPage()
    {
        return $this->requestedPage;
    }

    /**
     * Sets the ideal target page substitution
     *
     * @param int $targetPage
     *
     * @return $this
     */
    public function setTargetPage($targetPage)
    {
        $this->targetPage = $targetPage;

        return $this;
    }

    /**
     * Gets the ideal target page substitution
     *
     * @return int
     */
    public function getTargetPage()
    {
        return $this->targetPage;
    }


}
