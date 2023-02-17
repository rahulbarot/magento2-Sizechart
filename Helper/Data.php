<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const ALLOWED_PRODUCT_TYPES = "sizechart/general/allowed_product_types";
    const LINK_TEXT = "sizechart/modal/link_text";
    const MODAL_TITLE = "sizechart/modal/title";
    const MODAL_CLOSE_BTN_TEXT = "sizechart/modal/btn_text";
    const MODAL_COMMENTS = "sizechart/modal/comments";

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Allowed product types for sizechart
     */
    public function getAllowedProductTypes()
    {
        $allowedProductTypes = $this->scopeConfig->getValue(
            self::ALLOWED_PRODUCT_TYPES,
            ScopeInterface::SCOPE_STORE
        );
        return explode(',', $allowedProductTypes);
    }

    /**
     * Sizechart link text
     */
    public function getLinkText()
    {
        return $this->scopeConfig->getValue(
            self::LINK_TEXT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Sizechart modal title
     */
    public function getModalTitle()
    {
        return $this->scopeConfig->getValue(
            self::MODAL_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Sizechart modal close button text
     */
    public function getCloseBtnText()
    {
        return $this->scopeConfig->getValue(
            self::MODAL_CLOSE_BTN_TEXT,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Sizechart modal comments
     */
    public function getModalComments()
    {
        return $this->scopeConfig->getValue(
            self::MODAL_COMMENTS,
            ScopeInterface::SCOPE_STORE
        );
    }
}
