<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CountryTopic\ICountryTopicService;
use Illuminate\Http\Request;

class CountryTopicController extends Controller
{

    protected ICountryTopicService $countryTopicSer;

    public function __construct(ICountryTopicService $countryTopicSer)
    {
        $this->countryTopicSer = $countryTopicSer;
    }

    public function index(int $countryId)
    {
        $result = $this->countryTopicSer->index($countryId);

        $countryTopics = $result['topics'];
        $country =  $result['country'];
        
        return view('pages.countries-topics', compact('countryTopics', 'country'));
    }
}
