<?php

namespace App\Http\Controllers\API\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\HolidayPlan\CreateHolidayPlanRequest;
use App\Http\Requests\API\HolidayPlan\UpdateHolidayPlanRequest;
use App\Http\Resources\API\HolidayPlanResource;
use App\Models\HolidayPlan;

class HolidayPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $plans = HolidayPlan::all();

            $formatted_plans = HolidayPlanResource::collection($plans);

            return response()->json($formatted_plans);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when loading plans: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateHolidayPlanRequest $request)
    {
        try {
            $data = $request->validated();

            $holiday_plan = new HolidayPlan($data);

            $holiday_plan->save();
            return response()->json($holiday_plan, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when creating holiday plan.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HolidayPlan $holidayPlan)
    {
        try {
            return response()->json(new HolidayPlanResource($holidayPlan));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when searching a holiday plan.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHolidayPlanRequest $request, HolidayPlan $holidayPlan)
    {
        try {
            $data = $request->validated();

            $holidayPlan->update($data);

            return response()->json($holidayPlan, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when updating holiday plan.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HolidayPlan $holidayPlan)
    {
        try {
            $holidayPlan->delete();

            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error when deleting holiday plan.'], 500);
        }
    }
}
