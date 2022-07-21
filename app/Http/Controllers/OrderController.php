<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\ToyOrder;
use App\Models\Toy;
use App\Models\Postal;

class OrderController extends Controller
{
    public function _GET_postals(Request $request) {
        $postals = Postal::with('postalServices');

        return [
            'list' => $postals->get()
        ];
    }

    public function _POST(Request $request) {
        $token = $request->header('Authorization');
        
        if(!$token) {
            return response('Token is required', 422);
        }

        $errors = $this->validateOrder($request);

        if($errors) {
          return response($errors, 422);
        }
        $description = '';

        if($request['description']) {
            $description = $request['description'];
        }

        $newDelivery = Delivery::create([
            'PostalService_id' => $request['postal_service_id'],
            'City_id' => $request['city_id'],
        ]);
        $newDelivery = $newDelivery->fresh();
        
        $newOrder = Order::create([
            'description' => $description,
            'creation_date' => date("Y-m-d H:i:s"),
            'completition_date' => null,
            'Delivery_id' => $newDelivery->id,
            'User_id' => $request['user_id']
        ]);
        $newOrder = $newOrder->fresh();

        foreach($request['items'] as $orderItem) {
            $toy = Toy::find(intval($orderItem['id']));

            $newToyOrder = ToyOrder::create([
                'Toy_id' => $toy->id,
                'Order_id' => $newOrder->id,
                'quantity' => $orderItem['number'],
                'price' => $toy->price * $orderItem['number'],
            ]);
        }

        return response('OK', 200);
    }

    public function validateOrder(Request $request) {
        $validationRules = [
            'user_id' => ['required', 'exists:users,id'],
            'postal_service_id' => ['required', 'exists:postal_services,id'],
            'city_id' => ['required', 'exists:cities,id'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }
}
