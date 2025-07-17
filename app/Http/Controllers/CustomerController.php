<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $customers = Customer::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function report(Request $request): JsonResponse
    {
        $period = $request->input('period', 'all');

        $query = Customer::query();

        switch ($period) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
                break;
        }

        $customers = $query->get();

        $avgIncome = $customers->avg('household_income');

        $adultsAboveAvgIncome = $customers->filter(function ($customer) use ($avgIncome) {
            return Carbon::parse($customer->birth_date)->age >= 18
                && $customer->household_income > $avgIncome;
        })->count();

        $classA = $customers->where('household_income', '<=', 980)->count();
        $classB = $customers->filter(function ($c) {
            return $c->household_income > 980 && $c->household_income <= 2500;
        })->count();
        $classC = $customers->where('household_income', '>', 2500)->count();

        return response()->json([
            'avg_income' => round($avgIncome, 2),
            'adults_above_avg_income' => $adultsAboveAvgIncome,
            'class_A' => $classA,
            'class_B' => $classB,
            'class_C' => $classC,
        ]);
    }
}
