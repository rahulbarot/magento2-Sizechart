<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\ViewModel;

use DevAwesome\Sizechart\Model\Sizechart as SizechartModel;
use DevAwesome\Sizechart\Helper\Data;

class Sizechart extends \Magento\Framework\DataObject implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    private SizechartModel $sizeChart;
    private Data $dataHelper;

    /**
     * @param SizechartModel $sizeChart
     * @param Data $dataHelper
     */
    public function __construct(
        SizechartModel $sizeChart,
        Data $dataHelper
    ) {
        $this->sizeChart = $sizeChart;
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
            $imageUrl = $this->sizeChart->getSizeChartImageUrl($product);
            return $imageUrl;
        } catch (LocalizedException $e) {
            throw new LocalizedException(__($e->getMessage()), $e);
        }
    }

    /**
     * Get Sizechart configurations
     * 
     * @return Array
     */
    public function getSizeChartConfig()
    {
        return new \Magento\Framework\DataObject(
            [
                "link_text" => $this->dataHelper->getLinkText(),
                "title" => $this->dataHelper->getModalTitle(),
                "btn_text" => $this->dataHelper->getCloseBtnText(),
                "comments" => $this->dataHelper->getModalComments()
            ]
        );
    }
}