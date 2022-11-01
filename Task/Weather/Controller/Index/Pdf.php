<?php
namespace Task\Weather\Controller\Index;
use Task\Weather\Model\ResourceModel\Weather\CollectionFactory;
class Pdf extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $collectionFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        CollectionFactory $collectionFactory,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->collectionFactory = $collectionFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->collectionFactory ->create();;
        $pdf = new \Zend_Pdf(); //Create new PDF file
        $height = 550;
        $page = $pdf->newPage('1200:570');
        $page->setFont(\Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA), 13);  //Set Font
        $pdf->pages[] = $page;

        foreach ($collection as $item) {
            if($height <= 0){
                $page = $pdf->newPage('1200:570');
                $pdf->pages[] = $page;
                $height = 550;
            }
            if($height == 550) {
                $page->setFont(\Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA_BOLD), 13);  //Set Font
                $page->drawText('City', 15, $height);
                $page->drawText('Country', 70, $height);
                $page->drawText('Description', 150, $height);
                $page->drawText('Temperature', 260, $height);
                $page->drawText('Feels Like', 370, $height);
                $page->drawText('Pressure', 460, $height);
                $page->drawText('Humidity', 550, $height);
                $page->drawText('Wind Speed', 635, $height);
                $page->drawText('Sunrise', 785, $height);
                $page->drawText('Sunset', 935, $height);
                $page->drawText('Checked On', 1070, $height);
                $height -= 60;
                $width = $page->getWidth();
                $hight = $page->getHeight();
                $x = 30;
                $this->y = 630;
                $page->drawRectangle(0, $this->y -60, $page->getWidth(), $this->y - 100, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
                $page->setFont(\Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA), 13);
            }
            $page->drawText($item['city'], 10, $height);
            $page->drawText($item['country'], 80, $height);
            $page->drawText($item['description'], 140, $height);
            $page->drawText($item['temperature'], 260, $height);
            $page->drawText($item['feels_like'], 370, $height);
            $page->drawText($item['pressure'], 460, $height);
            $page->drawText($item['humidity'], 550, $height);
            $page->drawText($item['wind_speed'], 650, $height);
            $page->drawText($item['sunrise'], 750, $height);
            $page->drawText($item['sunset'], 900, $height);
            $page->drawText($item['checked_on'], 1050, $height);
            $pdfData = $pdf->render(); // Get PDF document as a string
            $height -= 40;
        }


        header("Content-Disposition: inline; filename=result.pdf");
        header("Content-type: application/x-pdf");
        echo $pdfData;
    }
}
