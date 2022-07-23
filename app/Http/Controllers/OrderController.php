<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\ToyOrder;
use App\Models\Toy;
use App\Models\Postal;
use App\Models\User;

class OrderController extends Controller
{
    public function _GET_postals(Request $request) {
        $postals = Postal::with('postalServices');

        return [
            'list' => $postals->get()
        ];
    }

    public function _GET_all_orders(Request $request) {
        $code = $this->checkIsAdmin($request);

        if($code == 422) {
            return response('Token is required', 422);
        }
        if($code == 404) {
            return response('User not found', 404);
        }
        if($code == 403) {
            return response('You don`t have rights to see this', 403);
        }

        $userOrders = Order::with(['user', 'status', 'toyOrders', 'delivery.city', 'delivery.postalService.postal'])->get();
        

        return [
            'list' => $userOrders
        ];
    }

    public function _GET_my_orders(Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return response('Token is required', 422);
        }

        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return response('User not found', 404);
        }

        $userOrders = Order::with(['status', 'toyOrders', 'delivery.city', 'delivery.postalService.postal'])->where('User_id', '=', $user->id)->get();
        

        return [
            'list' => $userOrders
        ];
    }

    public function _POST_change_status(Request $request) {
        $code = $this->checkIsAdmin($request);

        if($code == 422) {
            return response('Token is required', 422);
        }
        if($code == 404) {
            return response('User not found', 404);
        }
        if($code == 403) {
            return response('You don`t have rights to see this', 403);
        }

        $order = Order::find($request['id']);
        $order->OrderStatus_id = $request['status_id'];
        $order->save();

        return $order;
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
            'OrderStatus_id' => 1,
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

    public function checkIsAdmin(Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return 422;
        }

        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return 404;
        }
        if(!$user->is_admin) {
            return 403;
        }

        return 200;
    }
}
