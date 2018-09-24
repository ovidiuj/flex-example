<?php
namespace App\Service;

use App\DTO\DataDTO;
use App\DTO\CityDTO;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;

class HttpService
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $apiBaseUrl = 'https://yoc-media.github.io/weather/report/';

    /**
     *
     */
    const DEFAULT_COUNTRY = 'DE';

    /**
     *
     */
    const DEFAULT_CITY = 'Berlin';

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $response;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * HttpService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->httpClient = new Client();
        $this->setApiUrl();
    }

    /**
     * @param string $country
     * @param string $city
     */
    public function setApiUrl($country = self::DEFAULT_COUNTRY, $city = self::DEFAULT_CITY)
    {
        $this->apiUrl = $this->apiBaseUrl . $country . DIRECTORY_SEPARATOR . ucfirst($city) . '.json';
    }


    /**
     * @throws \Exception
     */
    public function getReportingData()
    {
        $res = $this->httpClient->request('GET', $this->apiUrl, []);
        if($res->getStatusCode() === Response::HTTP_OK) {
            $this->response = $res->getBody()->getContents();
        } else {
            throw new \Exception('Data provider is not available', $res->getStatusCode());
        }
        
    }

    /**
     * @return array|\JMS\Serializer\scalar|object
     */
    public function deserializeData()
    {
        if(empty($this->response) === false) {
            return $this->serializer->deserialize($this->response, 'array', 'json');
        }
    }

    /**
     * @return array
     */
    public function createDataTransferObjects()
    {
        $results = $this->deserializeData();
        $dtos = [];
        foreach ($results as $result) {
            $json = $this->serializer->serialize($result, 'json');
            $dtos[] = $this->serializer->deserialize($json, CityDTO::class, 'json');
        }
        return $dtos;
    }
}