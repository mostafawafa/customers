<?php

namespace App\Http\Controllers;

use App\Factories\ResourceRepresentationFactory;
use Customers\Services\CustomersGetter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Laravel\Lumen\Application;
use Laravel\Lumen\Http\ResponseFactory;
use Laravel\Lumen\Routing\Controller;

class CustomersController extends Controller
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return API response (JSON) to be used by clients
     * @param CustomersGetter $customersGetter
     * @return Response|ResponseFactory
     * @throws Exception
     */
    public function getCustomersApi(CustomersGetter $customersGetter)
    {
        $customers = $this->getCustomers($customersGetter);

        return response(ResourceRepresentationFactory::make('customer', $customers)->toJson());
    }

    /**
     * @param CustomersGetter $customersGetter
     * @return mixed
     */
    private function getCustomers(CustomersGetter $customersGetter)
    {
        $filters = [
            'phoneCountry' => strtolower($this->request->get('phoneCountry')),
            'isValidPhone' => $this->request->get('isValidPhone')
        ];

        return $customersGetter->getAll($filters);
    }

    /**
     * Return rendered view
     * @param CustomersGetter $customersGetter
     * @return View|Application
     * @throws Exception
     */
    public function getCustomersView(CustomersGetter $customersGetter)
    {
        $customers = $this->getCustomers($customersGetter);

        $countries = ['Morocco', 'Mozambique', 'Uganda', 'Ethiopia', 'Cameroon'];

        return view('customers', [
            'customers' => ResourceRepresentationFactory::make('customer', $customers)->toArray(),
            'countries' => $countries,
            'selectedCountry' => $this->request->get('phoneCountry'),
            'isValid' => $this->request->get('isValidPhone')
        ]);

    }
}
