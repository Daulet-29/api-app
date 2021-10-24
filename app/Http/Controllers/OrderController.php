<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Courier;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Метод создания заказа
    public function createOrder(Request $request)
    {
        $newOrder = new Order;
        $request->cost = rand(100, 1000);
        $validated = $request->validate(
            [
                'description' => 'required',
                'destination' => 'required',
            ]
        );
        $newOrder->description = $request->description;
        $newOrder->destination = $request->destination;
        $newOrder->cost = $request->cost;
        $newOrder->save();
        return $newOrder;
    }

    // Метод получения информации о заказе
    public function getOrderInformation(Request $request, $id)
    {
        $existingOrder = Order::find($id);
        return $existingOrder;
    }

    // Метод получение списка заказов
    public function getAllOrders()
    {
        $orders = Order::all();
        return $orders;
    }

    // Метод списка курьеров
    public function getAllCouriers()
    {
        $couriers = DB::table('couriers')->select('name', 'phone_number')->get();
        return $couriers;
    }

    // Метод списка свободных курьеров
    public function getFreeCouriers()
    {
        $freeCouriers = DB::table('couriers')::where('status', 'Свободен')->get();
    }

    // Метод закрепления заказа за курьером
    public function assigningOrderToCourier(Request $request, $id)
    {
        $freeCourier = Courier::where('status', 'Свободен')->get();

        // Чтобы курьеры могли получить заказы поочередно
        $queue = [];
        if($freeCourier==0){
            return ['Пока нет свободных курьеров'];
        }
        else if(sizeof($freeCourier)>1){
            for ($i=0; $i>count($freeCourier); $i++) {
                if($i=0){
                    $queue = $freeCourier[$i];
                }
                if($queue['updated_at']>$freeCourier[$i]['updated_at']){
                    $queue = $freeCourier[$i];
                }
            }
        } else {
            $queue = $freeCourier;
        }
        $queue->status = 'Занят';
        $queue->save();
        $assigning = Order::find($id);
        $assigning->courier_id = $queue['id'];
        $assigning->save();
        return [$assigning, $queue];
    }

    // Метод смены статуса заказа
    public function changeStatus(Request $request, $id)
    {
        $assigning = Order::find($id);
        $assigning->status = 'Курьер назначен';
        $assigning->save();
        return $assigning;
    }

    // Метод истории выполненных заказов курьером
    public function completedOrders(Request $request, $id)
    {
        $completedOrders = Order::where('courier_id', $id)->get();
    }
}
