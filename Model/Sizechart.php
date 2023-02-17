<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Model;

use Magento\Framework\Model\AbstractModel;
use DevAwesome\Base\Helper\Image as ImageHelper;
use DevAwesome\Sizechart\Helper\Data;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class Sizechart extends AbstractModel
{
    /**
     * Sizechart area inside media folder
     */
    public const SIZECHART_MEDIA_TMP_PATH = 'catalog/sizechart';
    /**
     * Sizechart temporary area inside media folder
     */
    public const SIZECHART_MEDIA_PATH = 'catalog/sizechart/tmp';
    /**
     * Sizechart area inside media folder with slash
     */
    public const SIZECHART_MEDIA_PATH_WS = 'catalog/sizechart/';

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
     * Get Sizechart Image Url
     * 
     * @param $product
     * @return Value|mixed|null
     * @throws LocalizedException
     */
    public function getSizeChartImageUrl($product)
    {
        try {
            $imageUrl = null;
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
