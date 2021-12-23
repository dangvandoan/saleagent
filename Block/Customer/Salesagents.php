<?php

namespace AHT\SalesAgents\Block\Customer;

class Salesagents extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_customerSession;
    protected $_resource;

    /**
     * @param \Magento\Customer\Model\Session
     */
    private $modelSession;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\ResourceConnection $Resource,


        \Magento\Customer\Model\Session $modelSession,
        array $data = []
    ) {
        $this->_customerSession = $customerSession;
        $this->_resource = $Resource;
        $this->modelSession = $modelSession;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $customerSession = $objectManager->create("Magento\Customer\Model\Session");

        if ($customerSession->isLoggedIn()) {
            $customerId = $customerSession->getCustomerId();
        }
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;

        // $customerId = $this->_customerSession->getCustomer()->getId();
        $collection = $this->_productCollectionFactory->create()->addAttributeToSelect(
            '*'
        )->addFieldToFilter(
            'sale_agent_id',
            $customerId
        )->addAttributeToSort(
            'name'
        );
        $collection->setPageSize($pageSize)->setCurPage($page);

        return $collection;

        
    }

      /**
     * No assign product message
     *
     * @return string
     */
    public function getEmptyProductMessage()
    {
        return "No product was assigned to you!";
    }

    /**
     * Get Pager child block output
     *
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getProductCollection()) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'saleagent.product.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getProductCollection()
                );
            $this->setChild('pager', $pager);
            $this->getProductCollection()->load();
        }
        return $this;
    }
}
