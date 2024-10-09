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
                    'recreations.id',
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
                'recreations.id',
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

    public function show($id)
    {
        try {
            $recreation = DB::table('recreations')
                ->join('recreation_has_packages', 'recreations.id', '=', 'recreation_has_packages.recreaction_id')
                ->leftJoin(DB::raw('(SELECT recreation_id, AVG(rate) as average_rating, COUNT(id) as total_ratings FROM recreation_ratings GROUP BY recreation_id) as ratings'), 'recreations.id', '=', 'ratings.recreation_id')
                ->select(
                    'recreations.id',
                    'recreations.business_name as name',
                    'recreations.city as city',
                    'recreations.address',
                    'recreation_has_packages.lat',
                    'recreation_has_packages.ltd',
                    DB::raw('MIN(recreation_has_packages.price) as min_price'),
                    DB::raw('IFNULL(ratings.average_rating, 0) as average_rating'),
                    DB::raw('IFNULL(ratings.total_ratings, 0) as total_ratings')
                )
                ->where('recreations.id', $id)
                ->where('recreations.is_active', 1)
                ->groupBy(
                    'recreations.id',
                    'recreations.business_name',
                    'recreations.city',
                    'recreations.address',
                    'recreation_has_packages.lat',
                    'recreation_has_packages.ltd',
                    'ratings.average_rating',
                    'ratings.total_ratings'
                )
                ->first();

            if (!$recreation) {
                return ResponseFormatter::error('Recreation not found', 404);
            }

            $packages = DB::table('recreation_has_packages')
                ->select('id','name', 'price',)
                ->where('recreaction_id', $id)
                ->get();

            $reviews = DB::table('recreation_ratings')
                ->join('users', 'recreation_ratings.users_id', '=', 'users.id')
                ->select(
                    'recreation_ratings.id',
                    'recreation_ratings.rate',
                    'recreation_ratings.comment',
                    'users.name as user',
                    'recreation_ratings.created_at'
                )
                ->where('recreation_ratings.recreation_id', $id)
                ->get();

            $result = [
                'id' => $recreation->id,
                'name' => $recreation->name,
                'city' => $recreation->city,
                'address' => $recreation->address,
                'lat' => $recreation->lat,
                'ltd' => $recreation->ltd,
                'min_price' => $recreation->min_price,
                'average_rating' => $recreation->average_rating,
                'total_ratings' => $recreation->total_ratings,
                'packages' => $packages,
                'reviews' => $reviews,
            ];

            return ResponseFormatter::success($result, 'Recreation data successfully loaded');
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Failed to load recreation data', 500);
        }
    }
}
