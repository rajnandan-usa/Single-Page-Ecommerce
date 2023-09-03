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

    public function addToCart($id){
    if(auth()->user()){
        // Get the user's cart for the specific product
        $cartItem = Shoppingcart::where('user_id', auth()->user()->id)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            // If the item is already in the cart, increment the quantity
            $cartItem->increment('quantity');
        } else {
            // If the item is not in the cart, create a new cart item
            Shoppingcart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $id,
                'quantity' => 1, // You can set the initial quantity as needed
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
