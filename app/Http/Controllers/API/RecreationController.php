<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Helpers\ResponseFormatter;
use PHPUnit\Exception;

class RecreationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $keywords = $request->input('keywords');
            $category = $request->input('category');

            $recreations = DB::table('recreations')
                ->join('recreation_has_packages', 'recreations.id', '=', 'recreation_has_packages.recreaction_id')
                ->leftJoin(DB::raw('(SELECT recreation_id, AVG(rate) as average_rating, COUNT(id) as total_ratings FROM recreation_ratings GROUP BY recreation_id) as ratings'), 'recreations.id', '=', 'ratings.recreation_id')
                ->select(
                    'recreations.business_name as name',
                    'recreations.city as city',
                    DB::raw('MIN(recreation_has_packages.price) as min_price'),
                    DB::raw('IFNULL(ratings.average_rating, 0) as average_rating'),
                    DB::raw('IFNULL(ratings.total_ratings, 0) as total_ratings')
                )
                ->where('recreations.is_active', 1);

            if (!is_null($keywords)) {
                $recreations->where('recreations.business_name', 'like', '%' . $keywords . '%');
            }

            if (!is_null($category)) {
                $recreations->where('recreation_has_packages.category_recreation_id', $category);
            }
            $recreations->groupBy(
                'recreations.business_name',
                'recreations.city',
                'ratings.average_rating',
                'ratings.total_ratings'
            );

            $recreationData = $recreations->get();

            if ($recreationData->isNotEmpty()) {
                return ResponseFormatter::success($recreationData, 'Data successfully loaded');
            } else {
                return ResponseFormatter::success([], 'No data found');
            }

        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Failed to load recreation data', 500);
        }
    }

}
