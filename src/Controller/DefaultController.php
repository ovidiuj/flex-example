<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\CityData;
use App\Repository\CityRepository;
use App\Service\ApiService;
use App\Service\Validator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * @var static
     */
    private $request;

    /**
     * @var Validator
     */
    private $validator;

    /**
     *
     */
    const DEFAULT_SORT = 'ASC';

    /**
     * @var array
     */
    private static $sortOptions = [
        'less' => 'ASC',
        'higher' => 'DESC'
    ];

    /**
     * DefaultController constructor.
     * @param ApiService $apiService
     * @param Validator $validator
     */
    public function __construct(ApiService $apiService, Validator $validator)
    {
        $this->apiService = $apiService;
        $this->request = Request::createFromGlobals();
        $this->validator = $validator;
    }

    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->json([
            'hello' => 'world!',
        ]);
    }

    /**
     * @Route("/city-data", name="default")
     */
    public function cityData()
    {

        $cityDataRepository = $this->getDoctrine()
            ->getRepository(CityData::class);
        $data = $cityDataRepository->getData($this->getRequestParams());
        $jsonData = $this->apiService->createDataTransferObjects($data);

        return $this->json($jsonData);
    }

    /**
     * @Route("/avg-temp", name="default")
     */
    public function avgTemp()
    {

        $cityDataRepository = $this->getDoctrine()
            ->getRepository(CityData::class);
        $data = $cityDataRepository->getAvgTemp($this->getRequestParams());

        $jsonData = $this->apiService->createDataTransferObjects($data);

        return $this->json($jsonData);
    }

    /**
     * @Route("/countries", name="default")
     */
    public function countries()
    {
        $results = [];
        $cityRepository = $this->getDoctrine()
            ->getRepository(City::class);
        $data = $cityRepository->getCountries();
        if(empty($data) === false && is_array($data)) {
            foreach ($data as $key => $country) {
                $results[$key]['code'] = $country['country_code'];
                $results[$key]['name'] = Intl::getRegionBundle()->getCountryName($country['country_code']);
            }

        }

        return $this->json($results);
    }

    /**
     * @Route("/country-cities", name="default")
     */
    public function countryCities()
    {
        $results = [];
        $countryCode = $this->request->query->get('country_code');
        $cityRepository = $this->getDoctrine()
            ->getRepository(City::class);
        $data = $cityRepository->getCountryCities($countryCode);

        if(empty($data) === false && is_array($data)) {
            foreach ($data as $key => $city) {
                if($city instanceof City) {
                    $results[$key]['country_code'] = $city->getCountryCode();
                    $results[$key]['country'] = Intl::getRegionBundle()->getCountryName($city->getCountryCode());
                    $results[$key]['name'] = $city->getCityName();
                }

            }

        }

        return $this->json($results);
    }

    /**
     * @return array
     */
    private function getRequestParams()
    {
        $params = [];
        $startDate = $this->request->query->get('start_date');
        if(empty($startDate) === false && $this->validator->validateDate($startDate)) {
            $params['minDate'] = $startDate;
        }
        $endDate = $this->request->query->get('end_date');
        if(empty($endDate) === false && $this->validator->validateDate($startDate)) {
            $params['maxDate'] = $endDate;
        }
        $temp = $this->request->query->get('temperature');
        if(empty($temp) === false) {
            $params['sort']['temp'] = isset(self::$sortOptions[$temp]) ? self::$sortOptions[$temp] : self::DEFAULT_SORT;
        }

        return $params;
    }




}
