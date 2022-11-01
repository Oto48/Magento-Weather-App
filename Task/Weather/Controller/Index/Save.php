<?php
namespace Task\Weather\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

use Task\Weather\Api\WeatherRepositoryInterface;
use Task\Weather\Api\Data\WeatherInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_weatherRepository;
    protected $_weatherModel;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        TimezoneInterface $timezone,
        WeatherRepositoryInterface $weatherRepository,
        WeatherInterface $weatherInterface
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_weatherRepository=$weatherRepository;
        $this->_weatherModel = $weatherInterface;
        $this->timezone = $timezone;
        return parent::__construct($context);
    }
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $get_name = $_GET['name'];

        $result = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q={$get_name}&APPID=02d4ef95dc836fe75d303b0643b0de74");
        $data = json_decode($result, true);
        print_r($data);

        if ($data) {
            $city = $data['name'];
            $country = $data['sys']['country'];
            $description = $data['weather'][0]['description'];
            $temperature = $data['main']['temp'];
            $feels_like = $data['main']['feels_like'];
            $pressure = $data['main']['pressure'];
            $humidity = $data['main']['humidity'];
            $wind_speed = $data['wind']['speed'];
            $sunrise = date("d M Y H:i:s", $data['sys']['sunrise'] );
            $sunset = date("d M Y H:i:s", $data['sys']['sunset'] );
            $checked_on = $this->timezone->date()->format('d M Y H:i:s');

            $this->_weatherModel->setCity($city);
            $this->_weatherModel->setCountry($country);
            $this->_weatherModel->setDescription($description);
            $this->_weatherModel->setTemperature($temperature);
            $this->_weatherModel->setFeelsLike($feels_like);
            $this->_weatherModel->setPressure($pressure);
            $this->_weatherModel->setHumidity($humidity);
            $this->_weatherModel->setWindSpeed($wind_speed);
            $this->_weatherModel->setSunrise($sunrise);
            $this->_weatherModel->setSunset($sunset);
            $this->_weatherModel->setCheckedOn($checked_on);

            try {
                $this->_weatherRepository->save($this->_weatherModel);
                $this->messageManager->addSuccess(__('Data Saved'));
            } catch (CouldNotSaveException $e) {
                echo $e->getMessage();
            }
            $sendData = array(
                "city" => $city,
                "country" => $country,
                "description" => $description,
                "temperature" => $temperature,
                "feels_like" => $feels_like,
                "pressure" => $pressure,
                "humidity" => $humidity,
                "wind_speed" => $wind_speed,
                "sunrise" => $sunrise,
                "sunset" => $sunset
            );
            return $resultRedirect->setPath('*/*/', array('_query' => $sendData));
        }
    }
}
