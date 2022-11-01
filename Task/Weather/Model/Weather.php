<?php
namespace Task\Weather\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Task\Weather\Api\Data\WeatherInterface;
use Task\Weather\Model\ResourceModel\Weather as ResourceModel;

/**
 * Class Customer
 */
class Weather extends AbstractModel implements
    WeatherInterface,
    IdentityInterface
{
    const CACHE_TAG = 'city_weather';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData('weather_id');
    }
    public function setId($weather_id)
    {
        return $this->setData('weather_id', $weather_id);
    }

    public function setCity($city)
    {
        return $this->setData('city', $city);
    }

    public function setCountry($country)
    {
        return $this->setData('country', $country);
    }

    public function setDescription($description)
    {
        return $this->setData('description', $description);
    }

    public function setTemperature($temperature)
    {
        return $this->setData('temperature', $temperature);
    }

    public function setFeelsLike($feels_like)
    {
        return $this->setData('feels_like', $feels_like);
    }

    public function setPressure($pressure)
    {
        return $this->setData('pressure', $pressure);
    }

    public function setHumidity($humidity)
    {
        return $this->setData('humidity', $humidity);
    }

    public function setWindSpeed($wind_speed)
    {
        return $this->setData('wind_speed', $wind_speed);
    }

    public function setSunrise($sunrise)
    {
        return $this->setData('sunrise', $sunrise);
    }

    public function setSunset($sunset)
    {
        return $this->setData('sunset', $sunset);
    }

    public function setCheckedOn($checked_on)
    {
        return $this->setData('checked_on', $checked_on);
    }
}
