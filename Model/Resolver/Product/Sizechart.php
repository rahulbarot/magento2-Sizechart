<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Model\Resolver\Product;

use DevAwesome\Sizechart\Model\Sizechart as SizechartModel;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Get product sizechart image
 */
class Sizechart implements ResolverInterface
{
    private SizechartModel $sizeChart;

    /**
     * @param SizechartModel $sizeChart
     */
    public function __construct(
        SizechartModel $sizeChart
    ) {
        $this->sizeChart = $sizeChart;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return Value|mixed|null
     * @throws LocalizedException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($value['model'])) {
            throw new LocalizedException(__('"model" value should be specified'));
        }

        try {
            $product = $value['model'];
            $imageUrl = $this->sizeChart->getSizeChartImageUrl($product);
            return $imageUrl;
        } catch (LocalizedException $e) {
            throw new LocalizedException(__($e->getMessage()), $e);
        }
    }
}
