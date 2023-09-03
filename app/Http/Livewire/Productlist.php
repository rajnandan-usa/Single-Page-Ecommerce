<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Shoppingcart;

class Productlist extends Component
{
    public $products;

    public function render()
    {
        $this->products = Product::get();

        return view('livewire.productlist');
    }
// add to cart
    public function addToCart($id){
    if(auth()->user()){
        $cartItem = Shoppingcart::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            
            $cartItem->increment('quantity');
        } else {
            Shoppingcart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
                'quantity' => 1, 
            ]);
        }

        $this->emit('updateCartCount');

        session()->flash('success','Product added to the cart successfully');
    } else {
        // Redirect to login page
        return redirect(route('login'));
    }
}

}
