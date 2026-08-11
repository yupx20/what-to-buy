/**
 * What to Buy — Main Application JavaScript
 * Handles cart interactions, drink customizer, toasts, and admin features.
 */

// ============================================
// Toast Notification System
// ============================================
window.showToast = function(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 4000);
};

// ============================================
// CSRF Token Helper
// ============================================
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.getAttribute('content') : '';
}

function fetchWithCsrf(url, options = {}) {
    return fetch(url, {
        ...options,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': getCsrfToken(),
            'X-Requested-With': 'XMLHttpRequest',
            ...(options.headers || {}),
        },
    });
}

// ============================================
// Mobile Navigation
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    const mobileToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Admin sidebar toggle
    const sidebarToggle = document.getElementById('admin-sidebar-toggle');
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            overlay?.classList.toggle('hidden');
        });
    }
});

// ============================================
// Cart Badge Update
// ============================================
function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;

    if (count > 0) {
        badge.textContent = count;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

// ============================================
// Drink Customizer Modal
// ============================================
let customizerState = {
    productId: null,
    productName: '',
    basePrice: 0,
    quantity: 1,
    selectedIceLevel: null,
    selectedSugarLevel: null,
    selectedToppings: [],
};

window.openCustomizer = function(productId, productName, basePrice) {
    const modal = document.getElementById('customizer-modal');
    if (!modal) return;

    // Reset state
    customizerState = {
        productId,
        productName,
        basePrice: parseFloat(basePrice),
        quantity: 1,
        selectedIceLevel: null,
        selectedSugarLevel: null,
        selectedToppings: [],
    };

    document.getElementById('customizer-product-name').textContent = productName;
    document.getElementById('customizer-product-id').value = productId;
    document.getElementById('customizer-qty').textContent = '1';

    // Render customization options
    renderCustomizationOptions();
    updateCustomizerTotal();

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
};

window.closeCustomizer = function() {
    const modal = document.getElementById('customizer-modal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
};

function renderCustomizationOptions() {
    const options = window.customizationOptions || {};

    // Ice levels
    const iceContainer = document.getElementById('ice-level-options');
    if (iceContainer && options.ice_level) {
        iceContainer.innerHTML = options.ice_level.map(opt => `
            <button type="button" class="option-pill" data-type="ice_level" data-id="${opt.id}" data-price="${opt.additional_price}"
                    onclick="selectOption('ice_level', ${opt.id}, ${opt.additional_price}, this)">
                ${opt.name}
                ${parseFloat(opt.additional_price) > 0 ? `<span class="price-tag">+$${parseFloat(opt.additional_price).toFixed(2)}</span>` : ''}
            </button>
        `).join('');
    }

    // Sugar levels
    const sugarContainer = document.getElementById('sugar-level-options');
    if (sugarContainer && options.sugar_level) {
        sugarContainer.innerHTML = options.sugar_level.map(opt => `
            <button type="button" class="option-pill" data-type="sugar_level" data-id="${opt.id}" data-price="${opt.additional_price}"
                    onclick="selectOption('sugar_level', ${opt.id}, ${opt.additional_price}, this)">
                ${opt.name}
                ${parseFloat(opt.additional_price) > 0 ? `<span class="price-tag">+$${parseFloat(opt.additional_price).toFixed(2)}</span>` : ''}
            </button>
        `).join('');
    }

    // Toppings
    const toppingContainer = document.getElementById('topping-options');
    if (toppingContainer && options.topping) {
        toppingContainer.innerHTML = options.topping.map(opt => `
            <button type="button" class="option-pill" data-type="topping" data-id="${opt.id}" data-price="${opt.additional_price}"
                    onclick="toggleTopping(${opt.id}, ${opt.additional_price}, this)">
                ${opt.name}
                <span class="price-tag">+$${parseFloat(opt.additional_price).toFixed(2)}</span>
            </button>
        `).join('');
    }
}

window.selectOption = function(type, id, price, el) {
    // Deselect siblings
    el.parentElement.querySelectorAll('.option-pill').forEach(p => p.classList.remove('selected'));
    el.classList.add('selected');

    if (type === 'ice_level') {
        customizerState.selectedIceLevel = { id, price: parseFloat(price) };
    } else if (type === 'sugar_level') {
        customizerState.selectedSugarLevel = { id, price: parseFloat(price) };
    }

    updateCustomizerTotal();
};

window.toggleTopping = function(id, price, el) {
    const index = customizerState.selectedToppings.findIndex(t => t.id === id);

    if (index > -1) {
        customizerState.selectedToppings.splice(index, 1);
        el.classList.remove('selected');
    } else {
        if (customizerState.selectedToppings.length >= 3) {
            showToast('You can select a maximum of 3 toppings.', 'error');
            return;
        }
        customizerState.selectedToppings.push({ id, price: parseFloat(price) });
        el.classList.add('selected');
    }

    updateCustomizerTotal();
};

window.updateCustomizerQty = function(delta) {
    customizerState.quantity = Math.max(1, Math.min(10, customizerState.quantity + delta));
    document.getElementById('customizer-qty').textContent = customizerState.quantity;
    updateCustomizerTotal();
};

function updateCustomizerTotal() {
    let unitPrice = customizerState.basePrice;

    if (customizerState.selectedIceLevel) {
        unitPrice += customizerState.selectedIceLevel.price;
    }
    if (customizerState.selectedSugarLevel) {
        unitPrice += customizerState.selectedSugarLevel.price;
    }
    customizerState.selectedToppings.forEach(t => {
        unitPrice += t.price;
    });

    const total = unitPrice * customizerState.quantity;
    document.getElementById('customizer-total').textContent = '$' + total.toFixed(2);
}

// Handle customizer form submission
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('customizer-form');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const body = {
            product_id: customizerState.productId,
            quantity: customizerState.quantity,
            ice_level_id: customizerState.selectedIceLevel?.id || null,
            sugar_level_id: customizerState.selectedSugarLevel?.id || null,
            topping_ids: customizerState.selectedToppings.map(t => t.id),
        };

        try {
            const response = await fetchWithCsrf('/cart/add', {
                method: 'POST',
                body: JSON.stringify(body),
            });

            const data = await response.json();

            if (data.success) {
                showToast(data.message || 'Added to cart!', 'success');
                updateCartBadge(data.cartCount);
                closeCustomizer();
            } else {
                showToast(data.message || 'Failed to add item.', 'error');
            }
        } catch (err) {
            showToast('Something went wrong. Please try again.', 'error');
        }
    });
});

// ============================================
// Admin: AJAX Stock Toggle
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toggle-stock-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                const data = await response.json();

                if (data.success) {
                    const toggle = form.querySelector('.toggle');
                    toggle.classList.toggle('active', data.is_in_stock);
                    showToast(data.message, 'success');
                }
            } catch (err) {
                showToast('Failed to update stock.', 'error');
            }
        });
    });
});

// ============================================
// Admin: AJAX Order Advance
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.advance-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                const data = await response.json();

                if (data.success) {
                    showToast(`Order advanced to ${data.status_label}`, 'success');
                    // Reload to reflect new state
                    setTimeout(() => window.location.reload(), 800);
                } else {
                    showToast(data.message || 'Failed to advance order.', 'error');
                }
            } catch (err) {
                showToast('Failed to advance order.', 'error');
            }
        });
    });
});

// ============================================
// Checkout: Delivery fee toggle
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    const fulfillmentRadios = document.querySelectorAll('input[name="fulfillment_type"]');
    const deliveryFeeRow = document.getElementById('delivery-fee-row');
    const checkoutTotal = document.getElementById('checkout-total');

    if (fulfillmentRadios.length && checkoutTotal) {
        const subtotalEl = checkoutTotal.closest('.space-y-2');
        let baseTotal = 0;

        // Parse the initial total from the page
        const totalText = checkoutTotal.textContent.replace('$', '').replace(',', '');
        baseTotal = parseFloat(totalText) || 0;

        fulfillmentRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'delivery') {
                    deliveryFeeRow?.classList.remove('hidden');
                    checkoutTotal.textContent = '$' + (baseTotal + 3.99).toFixed(2);
                } else {
                    deliveryFeeRow?.classList.add('hidden');
                    checkoutTotal.textContent = '$' + baseTotal.toFixed(2);
                }
            });
        });
    }
});

// ============================================
// Alpine.js-like dropdown (simple implementation)
// ============================================
document.addEventListener('click', (e) => {
    // Close user dropdown when clicking outside
    const dropdowns = document.querySelectorAll('[x-data]');
    dropdowns.forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            const menu = dropdown.querySelector('[x-show]');
            if (menu) menu.style.display = 'none';
        }
    });
});

// Simple x-data/x-show handler for user dropdown
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[x-data]').forEach(el => {
        const toggle = el.querySelector('[\\@click]');
        const menu = el.querySelector('[x-show]');

        if (toggle && menu) {
            menu.style.display = 'none';
            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
            });
        }
    });
});
