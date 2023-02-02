<?php
/**
 * Copyright © MageRahul All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace DevAwesome\Sizechart\Controller\Adminhtml\Sizechart;

use Magento\Backend\App\Action\Context;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use DevAwesome\Sizechart\Model\Sizechart;
use DevAwesome\Base\Model\AbstractImageUpload;

class Save extends \Magento\Backend\App\Action
{
    protected $dataPersistor;
    private AttributeSetRepositoryInterface $attributeSetRepository;
    private AbstractImageUpload $imageUploader;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param AttributeSetRepositoryInterface $attributeSetRepository
     * @param AbstractImageUpload $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        AttributeSetRepositoryInterface $attributeSetRepository,
        AbstractImageUpload $imageUploader
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->attributeSetRepository = $attributeSetRepository;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('attribute_set_id');

            $attributeSet = $this->attributeSetRepository->get($id);
            if (!$attributeSet->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Sizechart no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            // Move image from tmp to upload directory START
            if (isset($data['sizechart_image'][0]['name']) && isset($data['sizechart_image'][0]['tmp_name'])) {
                $data['sizechart_image'] = $data['sizechart_image'][0]['name'];
                $this->imageUploader->moveFileFromTmp($data['sizechart_image']);
            } elseif (isset($data['sizechart_image'][0]['name']) && !isset($data['sizechart_image'][0]['tmp_name'])) {
                $data['sizechart_image'] = $data['sizechart_image'][0]['name'];
            } else {
                $data['sizechart_image'] = null;
            }

            if ($data['sizechart_image'] !== null) {
                $data['sizechart_image'] = Sizechart::SIZECHART_MEDIA_PATH_WS . $data['sizechart_image'];
            }
            // Move image from tmp to upload directory END

            $attributeSet->setData("sizechart_image", $data['sizechart_image']);

            try {
                $this->attributeSetRepository->save($attributeSet);
                $this->messageManager->addSuccessMessage(__('You saved the Sizechart.'));
                $this->dataPersistor->clear('devawesome_sizechart');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['attribute_set_id' => $attributeSet->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Sizechart.'));
            }

            $this->dataPersistor->set('devawesome_sizechart', $data);
            return $resultRedirect->setPath('*/*/edit', ['attribute_set_id' => $this->getRequest()->getParam('attribute_set_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
