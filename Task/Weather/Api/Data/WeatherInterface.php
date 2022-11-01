<?php
namespace Task\Weather\Api\Data;

/**
 * Interface WeatherInterface
 *
 * @api
 */
interface WeatherInterface
{
    /**
     * @param int $weather_id
     * @return $this
     */
    public function setId($weather_id);

    /**
     * @param string $city
     * @return $this
     */
    public function setCity($city);

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * @param string $temperature
     * @return $this
     */
    public function setTemperature($temperature);

    /**
     * @param string $feels_like
     * @return $this
     */
    public function setFeelsLike($feels_like);

    /**
     * @param string $pressure
     * @return $this
     */
    public function setPressure($pressure);

    /**
     * @param string $humidity
     * @return $this
     */
    public function setHumidity($humidity);

    /**
     * @param string $wind_speed
     * @return $this
     */
    public function setWindSpeed($wind_speed);

    /**
     * @param string $sunrise
     * @return $this
     */
    public function setSunrise($sunrise);

    /**
     * @param string $sunset
     * @return $this
     */
    public function setSunset($sunset);

    /**
     * @param string $checked_on
     * @return $this
     */
    public function setCheckedOn($checked_on);
}
