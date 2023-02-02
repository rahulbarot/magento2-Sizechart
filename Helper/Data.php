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
}
