<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Model;

use Magento\Framework\Model\AbstractModel;

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
}
