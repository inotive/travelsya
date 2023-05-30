<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ads = Ad::where('is_active', 1)->get();

            if (count($ads)) {
                return ResponseFormatter::success($ads, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (\Throwable $th) {
            throw $th;
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Ads failed', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data['is_active'] = 1;
            $validator = Validator::make($request->all(), [
                "name" => "string",
                "url" => "string",
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Transaction failed', 500);
            }

            $data['image'] = $request->file('image')->store(
                'ads',
                'public',
            );
            $store = Ad::create($data);

            if (!$store)
                return ResponseFormatter::error(null, 'Add create failed');


            return ResponseFormatter::success($store, 'Add successfully created');
        } catch (\Throwable $th) {
            throw $th;
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Ads failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad, $id)
    {
        try {
            $ads = Ad::find($id);

            if (count($ads)) {
                return ResponseFormatter::success($ads, 'Data successfully loaded');
            } else {
                return ResponseFormatter::error(null, 'Data not found');
            }
        } catch (\Throwable $th) {
            throw $th;
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Transaction failed', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($request->all(), [
                "id" => "required",
                "name" => "string",
                "url" => "string",
                // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return ResponseFormatter::error([
                    'response' => $validator->errors(),
                ], 'Transaction failed', 500);
            }

            if ($request->file('image')) {
                $data['image'] = $request->file('image')->store(
                    'ads',
                    'public',
                );
            }
            $ad = Ad::find($data['id']);
            $update = $ad->update($data);

            if (!$update)
                return ResponseFormatter::error(null, 'Add update failed');


            return ResponseFormatter::success($update, 'Add successfully updated');
        } catch (\Throwable $th) {
            throw $th;
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Ads failed', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad, $id)
    {
        try {
            $ads = Ad::find($id);

            $delete = $ads->delete();

            if (count($delete)) {
                return ResponseFormatter::success($delete, 'Data successfully deleted');
            } else {
                return ResponseFormatter::error(null, 'Deleted error');
            }
        } catch (\Throwable $th) {
            throw $th;
            return ResponseFormatter::error([
                $th,
                'message' => 'Something wrong',
            ], 'Transaction failed', 500);
        }
    }
}
