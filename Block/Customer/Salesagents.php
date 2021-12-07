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

        // $this->_customerSession->getData();
        // //var_dump($this->_customerSession->getCustomerId());die("aaa");

        // if($this->_customerSession->isLoggedIn()) {
        //     echo '1';die;
        // }
        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        // $customerSession = $objectManager->create("Magento\Customer\Model\Session");

        // if ($customerSession->isLoggedIn()) {
        //     $customerId = $customerSession->getCustomerId();
        // }

        // $customerId = $this->_customerSession->getCustomerId();
        // $collection = $this->_productCollectionFactory->create();

        // $collection->addAttributeToSelect('*')->addAttributeToFilter('sale_agent_id', array('like' => '1'));
        // $collection->addAttributeToSelect('*')->addFieldToFilter('sale_agent_id', 1);
        // //     echo "<pre>";
        // // $a = $collection->addAttributeToSelect('*')->getData();
        // // var_dump($a); die;

        // $aht_sales_agent = $this->_resource->getTableName('aht_sales_agent');

        // // $collection->getSelect()
        // // ->joinleft('blog_comments as item',
        // //     'main_table.post_id=item.post_id', 
        // //     array('main_table.*', 'count(item.cmt_id) as sl',
        // // ));

        // $collection->getSelect()->join(
        //     ['order_sa' => $aht_sales_agent],
        //     'e.entity_id = 1 '
        // );


        // $collection->setPageSize(5);

        // // var_dump($collection->getData());
        // return $collection;



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
}
