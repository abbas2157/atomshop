<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\{City, Area};
use Illuminate\Support\Facades\{Auth, DB};

class CityAreaController extends BaseController
{
     /**
     * Get All City For App
     */
    public function cities(Request $request)
    {
        try {
            $cities = City::where('status', 'active')->select('id','title','slug','provice','country')->get();
            return $this->sendResponse($cities, 'Here is the list of cities.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function areas(Request $request)
    {
        try {
            $areas = Area::where('status', 'active')->select('id','title','slug','lat','lng','city_id')->get();
            return $this->sendResponse($areas, 'Here is the list of areas.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
    public function areas_with_city_id(Request $request, $city_id)
    {
        try {
            $areas = Area::where('status', 'active')->select('id','title','slug','lat','lng','city_id')->where('city', $city_id)->get();
            return $this->sendResponse($areas, 'Here is the list of areas.', 200);
        } catch (Exception $e) {
            return $this->sendError('Something went wrong.', $e->getMessage(), 500);
        }
    }
}
