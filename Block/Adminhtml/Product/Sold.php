<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\SalesAgents\Block\Adminhtml\Product;

/**
 * Backend Report Sold Product Content Block
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Sold extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @var string
     */
    protected $_blockGroup = 'AHT_SalesAgents';

    /**
     * Initialize container block settings
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'AHT_SalesAgents';
        $this->_headerText = __('Products Commission');
        parent::_construct();
        $this->buttonList->remove('add');
    }
}
