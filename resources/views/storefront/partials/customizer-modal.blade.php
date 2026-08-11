{{-- Drink Customizer Modal --}}
<div id="customizer-modal" class="fixed inset-0 z-[60] hidden" role="dialog" aria-modal="true">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeCustomizer()"></div>

    {{-- Modal Content --}}
    <div class="absolute bottom-0 left-0 right-0 md:bottom-auto md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2 md:max-w-lg md:w-full">
        <div class="bg-white rounded-t-3xl md:rounded-3xl shadow-2xl max-h-[85vh] overflow-y-auto">
            {{-- Header --}}
            <div class="sticky top-0 bg-white/95 backdrop-blur-sm p-6 pb-4 border-b border-cream-100 z-10 rounded-t-3xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 id="customizer-product-name" class="font-display font-bold text-xl text-gray-900"></h3>
                        <p class="text-sm text-gray-500 mt-0.5">Customize your drink</p>
                    </div>
                    <button onclick="closeCustomizer()" class="w-9 h-9 rounded-full bg-cream-100 flex items-center justify-center hover:bg-cream-200 transition-colors">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <form id="customizer-form" class="p-6 space-y-6">
                <input type="hidden" name="product_id" id="customizer-product-id">
                <input type="hidden" name="quantity" value="1">

                {{-- Ice Level --}}
                <div>
                    <label class="input-label">
                        <svg class="w-4 h-4 inline mr-1 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L4 9v12h16V9l-8-6z"/></svg>
                        Ice Level
                    </label>
                    <div class="flex flex-wrap gap-2 mt-2" id="ice-level-options">
                        {{-- Populated by JS --}}
                    </div>
                </div>

                {{-- Sugar Level --}}
                <div>
                    <label class="input-label">
                        <svg class="w-4 h-4 inline mr-1 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.27 5.82 22 7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                        Sweetness Level
                    </label>
                    <div class="flex flex-wrap gap-2 mt-2" id="sugar-level-options">
                        {{-- Populated by JS --}}
                    </div>
                </div>

                {{-- Toppings --}}
                <div>
                    <label class="input-label">
                        <svg class="w-4 h-4 inline mr-1 text-pink-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-4-4 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/></svg>
                        Toppings <span class="text-xs text-gray-400 font-normal">(max 3)</span>
                    </label>
                    <div class="flex flex-wrap gap-2 mt-2" id="topping-options">
                        {{-- Populated by JS --}}
                    </div>
                </div>

                {{-- Quantity --}}
                <div>
                    <label class="input-label">Quantity</label>
                    <div class="flex items-center gap-3 mt-2">
                        <button type="button" onclick="updateCustomizerQty(-1)" class="w-10 h-10 rounded-full border-2 border-cream-200 flex items-center justify-center hover:border-lavender-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M5 12h14"/></svg>
                        </button>
                        <span id="customizer-qty" class="font-display font-bold text-xl w-8 text-center">1</span>
                        <button type="button" onclick="updateCustomizerQty(1)" class="w-10 h-10 rounded-full border-2 border-cream-200 flex items-center justify-center hover:border-lavender-400 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" d="M12 5v14m7-7H5"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Price Summary & Add Button --}}
                <div class="pt-4 border-t border-cream-100">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm text-gray-500">Total</span>
                        <span id="customizer-total" class="font-display font-bold text-2xl text-lavender-600">$0.00</span>
                    </div>
                    <button type="submit" class="btn btn-primary w-full btn-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Add to Cart
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
