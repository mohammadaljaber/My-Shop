<?

namespace App\Http\Controllers\Repositories\Order;

use App\Http\Controllers\Repositories\BaseRepository;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends BaseRepository{


    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function index(){
        return auth()->user->orders;
    }

    public function store($data): Model
    {
        $order=auth()->user->orders->cerate([
            'costumer_id'=>auth()->user->id,
            'total_price'=>0
        ]);
        $total_price=$this->storeOrderItems($data,$order);

        $order->total_price=$total_price;
        $order->update();
        return $order;
    }


    private function storeOrderItems($items,Order $order){
        $total_price=0;
        foreach($items->products as $item){
            $quantity=$item['products']['count'];
            $product=Stock::find($item['products']['id']);
            $total_price+=$this->attachProductToOrderItems($order,$product,$quantity);
        }

        return $total_price;
    }

    private function attachProductToOrderItems(Order $order,Stock $product,$quantity=1){
        $productPrice=$product->price;
        ($productPrice)?:$product->product->price;
        $order->contents->create([
            'quantity'=>$quantity,
            'price'=>$productPrice*$quantity,
            'contentable_id'=>$product->id,
            'contentable_type'=>Stock::class
        ]);
        $product->quantity-=$quantity;
        $product->update();
        return $productPrice*$quantity;
    }

    private function attachOffersToOrderItems(){

    }

}
