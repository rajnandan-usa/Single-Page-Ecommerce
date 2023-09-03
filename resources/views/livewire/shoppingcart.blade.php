<div>
    @include('layouts.flash-message')
    <div class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
            <div class="flex-1">
                  <!-- Billing Details Form -->
                  <form wire:submit.prevent="storeBillingDetails" class="mb-6">
                    <div class="mb-4">
                        <h1 class="text-xl font-bold mb-2">Billing Details</h1>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input wire:model="billingDetails.first_name" type="text" id="first_name" name="first_name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input wire:model="billingDetails.last_name" type="text" id="last_name" name="last_name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Email</label>
                            <input wire:model="billingDetails.email" type="email" id="email" name="email" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Address</label>
                            <input wire:model="billingDetails.address" type="text" id="address" name="address" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">City</label>
                            <input wire:model="billingDetails.city" type="text" id="city" name="city" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">State</label>
                            <input wire:model="billingDetails.state" type="text" id="state" name="state" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Zip Code</label>
                            <input wire:model="billingDetails.zip_code" type="text" id="zip_code" name="zip_code" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            Save Billing Details
                        </button>
                    </div>
                </form>
                <table class="w-full text-sm lg:text-base" cellspacing="0">
                    <thead>
                        <tr class="h-12 uppercase">
                            <th class="hidden md:table-cell"></th>
                            <th class="text-left">Product</th>
                            <th class="lg:text-right text-left pl-5 lg:pl-0">
                                <span class="lg:hidden" title="Quantity">Qtd</span>
                                <span class="hidden lg:inline">Quantity</span>
                            </th>
                            <th class="hidden text-right md:table-cell">Unit price</th>
                            <th class="text-right">Total price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartitems as $item)
                        <tr>
                            <td class="hidden pb-4 md:table-cell">
                                <a href="#">
                                    <img src="{{ $item->product->image }}" class="w-20 rounded" alt="Thumbnail" />
                                </a>
                            </td>
                            <td>
                                <p class="mb-2 md:ml-4">{{ $item->product->name}}</p>
                                <button type="submit" class="md:ml-4 text-red-700" wire:click="removeItem({{ $item->id }})">
                                    <small>(Remove item)</small>
                                </button>
                            </td>
                            <td class="justify-center md:justify-end md:flex mt-6">
                                <div class="w-20 h-10">
                                    <div class="custom-number-input h-10 w-32">
                                        <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                            <button class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none" wire:click="decrementQty({{ $item->id }})">
                                                <span class="m-auto text-2xl font-thin">−</span>
                                            </button>
                                            <span class="p-2">{{ $item->quantity}}</span>
                                            <button class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer" wire:click="incrementQty({{ $item->id }})">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ $item->product->price }}$
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ $item->product->price * $item->quantity }}$
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr class="pb-6 mt-6" />
                <div class="my-4 mt-6 -mx-2 lg:flex">
                    <div class="lg:px-2 lg:w-1/2"></div>
                    <div class="lg:px-2 lg:w-1/2">
                        <div class="p-4 bg-gray-100 rounded-full">
                            <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Subtotal
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    {{ $sub_total }}$
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Tax
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    {{ $tax }}$
                                </div>
                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Total
                                </div>
                                <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                    {{ $this->total }}$
                                </div>
                            </div>

                            <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none" wire:click="checkout" wire:loading.attr="disabled">
                                <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        fill="currentColor"
                                        d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"
                                    />
                                </svg>
                                <span class="ml-2 mt-5px">Procceed to checkout</span>
                            </button>
                            <div wire:loading class="text-center mt-4">
                          <div class="inline-block animate-spin ease-linear rounded-full border-t-4 border-blue-500 border-opacity-25 h-8 w-8"></div>
                          <p class="text-gray-700 text-lg mt-2">Processing payment...</p>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
