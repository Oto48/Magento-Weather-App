<?php
namespace Task\Weather\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_coreRegistry;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        return parent::__construct($context);
    }
    public function execute()
    {
        $param = $this->getRequest()->getParams();
        $this->_coreRegistry->register('data', $param);
        return $this->_pageFactory->create();
    }
}
