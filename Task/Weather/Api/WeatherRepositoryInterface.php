<?php
namespace Task\Weather\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Task\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface WeatherRepositoryInterface
 *
 * @api
 */
interface WeatherRepositoryInterface
{
    /**
     *
     * @param WeatherInterface $weather
     * @return WeatherInterface
     */
    public function save(WeatherInterface $weather);

    /**
     *
     * @param int $id
     * @return WeatherInterface
     * @throws NoSuchEntityException If Weather with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById($id);
}
