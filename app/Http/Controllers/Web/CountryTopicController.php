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
        $remainTopics = $result['remainTopics'];
        return view('pages.countries-topics', compact('countryTopics', 'country', 'remainTopics'));
    }

    public function storeTopic(Request $request, int $countryId)
    {
        $countryTopic = $this->countryTopicSer->storeTopic($request, $countryId);
        return redirect()->back()->with('response', $countryTopic);
    }

    public function delete(int $id)
    {
        $result = $this->countryTopicSer->delete($id);
        return redirect()->back()->with('response', $result);
    }
}
