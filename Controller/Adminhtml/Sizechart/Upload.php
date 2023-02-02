<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Controller\Adminhtml\Sizechart;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use DevAwesome\Base\Model\AbstractImageUpload;

class Upload extends Action
{
    public const PARAM_NAME = 'sizechart_image';

    /**
     * @var AbstractImageUpload
     */
    private $imageUploader;

    /**
     * Save constructor.
     * @param Context $context
     * @param AbstractImageUpload $imageUploader
     */
    public function __construct(
        Context $context,
        AbstractImageUpload $imageUploader
    ) {
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * Upload file controller action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir(self::PARAM_NAME);

            $session = $this->_getSession();
            $result['cookie'] = [
                'name' => $session->getName(),
                'value' => $session->getSessionId(),
                'lifetime' => $session->getCookieLifetime(),
                'path' => $session->getCookiePath(),
                'domain' => $session->getCookieDomain(),
                'upload' => true
            ];
        } catch (Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
