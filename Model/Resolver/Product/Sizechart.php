<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Model\Resolver\Product;

use DevAwesome\Base\Helper\Image as ImageHelper;
use DevAwesome\Sizechart\Helper\Data;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
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
    private AttributeSetRepositoryInterface $attributeSetRepository;
    private ImageHelper $imageHelper;
    private Data $dataHelper;

    /**
     * @param AttributeSetRepositoryInterface $attributeSetRepository
     * @param ImageHelper $imageHelper
     * @param Data $dataHelper
     */
    public function __construct(
        AttributeSetRepositoryInterface $attributeSetRepository,
        ImageHelper $imageHelper,
        Data $dataHelper
    ) {
        $this->attributeSetRepository = $attributeSetRepository;
        $this->imageHelper = $imageHelper;
        $this->dataHelper = $dataHelper;
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
            $imageUrl = null;
            $product = $value['model'];
            $attributeSetId = $product->getAttributeSetId();
            $productType = $product->getTypeId();
            $allowedProductTypes = $this->dataHelper->getAllowedProductTypes();

            if (in_array($productType, $allowedProductTypes)) {
                $attributeSet = $this->attributeSetRepository->get($attributeSetId);
                if ($attributeSet && $attributeSet->getData('sizechart_image') !== null) {
                    $imageUrl = $this->imageHelper->getMediaUrl($attributeSet->getData('sizechart_image'));
                }
            }
            return $imageUrl;
        } catch (LocalizedException $e) {
            throw new LocalizedException(__($e->getMessage()), $e);
        }
    }
}
