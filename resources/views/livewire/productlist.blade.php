<div>
    @include('layouts.flash-message')
    <main class="my-2">
        <div class="container mx-auto px-6">
            <h3 class="text-gray-700 text-2xl font-medium mb-6">Products</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4">
                @foreach($products as $product)
                <div class="w-full p-4">
                    <div class="card bg-white rounded-lg shadow-2xl">
                        <div class="prod-title p-4">
                            <p class="text-2xl uppercase text-gray-700 font-bold">{{ $product->name }}</p>
                            <p class="lowercase text-sm text-gray-400">
                                @php
                                    $description = $product->description;
                                    $words = explode(' ', $description);
                                    $maxWords = 20; // Change this to your desired word limit
                                    $shortDescription = implode(' ', array_slice($words, 0, $maxWords));

                                    $isLongDescription = count($words) > $maxWords;
                                @endphp

                                {{ $isLongDescription ? $shortDescription : $description }}

                                @if ($isLongDescription)
                                    <span id="more-{{ $product->id }}" style="display:none;">
                                        {{ implode(' ', array_slice($words, $maxWords)) }}
                                    </span>
                                    <a
                                        href="#"
                                        class="text-blue-600 hover:underline read-more"
                                        data-product-id="{{ $product->id }}"
                                    >
                                        Read More
                                    </a>
                                @endif
                            </p>
                        </div>
                        <div class="prod-img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                class="w-full h-64 object-cover object-center" />
                        </div>
                        <div class="prod-info p-4">
                            <div class="flex flex-col md:flex-row justify-between items-center text-gray-900">
                                <p class="font-bold text-xl">${{ $product->price }}</p>
                                <button
                                    class="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none"
                                    wire:click="addToCart({{ $product->id }})">
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreLinks = document.querySelectorAll('.read-more');

        readMoreLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const productId = link.getAttribute('data-product-id');
                const moreText = document.getElementById(`more-${productId}`);

                if (moreText.style.display === 'none' || moreText.style.display === '') {
                    moreText.style.display = 'inline';
                    link.textContent = 'Read Less';
                } else {
                    moreText.style.display = 'none';
                    link.textContent = 'Read More';
                }
            });
        });
    });
</script>