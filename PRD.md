# Product Requirement Document (PRD)
# Project Name: What to Buy
**Boutique Boba & Milk Tea E-Commerce Platform**

---

## 1. Executive Summary
**What to Buy** is a vibrant, modern e-commerce platform designed for a boutique boba and milk tea shop. Built on the **"Boba Pop"** design system, the application pairs a playful, consumer-facing mobile/desktop storefront with a high-efficiency administrative workspace. 

The platform enables customers to discover, customize, and order beverages seamlessly while providing shop owners and baristas real-time operational control over orders, stock, and business analytics.

---

## 2. Target Audience & Personas
* **The Customer (Gen Z & Millennial Boba Enthusiast):** Values aesthetic presentation, mobile-first responsiveness, quick customization options, and transparent real-time order tracking.
* **The Shop Admin / Barista:** Requires a fast, high-contrast, data-dense web and mobile interface to queue orders, transition order statuses with single-click actions, and toggle ingredient stock instantly.

---

## 3. Visual Identity & Design System ("Boba Pop")

### 3.1 Design Principles
* **Playful Customer Experience:** Rounded cards (`32px` radius), ambient drop-shadows, chunky display typography, and 3D rendered flavor mascots.
* **Utility-Driven Admin Interface:** Reduced border radii (`16px`), high contrast, tight data density, and clear status color coding.

### 3.2 Color Palette & Typography
* **Primary Brand (Soft Lavender):** `#8a76d1`
* **Secondary Brand (Matcha Green):** `#6cae7c` *(Used for In-Stock & Fresh indicators)*
* **Accent (Strawberry Pink):** `#ff6b8b` *(Used for Best Seller & Seasonal badges)*
* **Surface Backgrounds:** `#fdfbf7` (Creamy Off-White) / `#ffffff` (Admin Cards)
* **Display Typography:** Bricolage Grotesque (Headings, buttons, badges)
* **Body Typography:** Plus Jakarta Sans (Data tables, forms, copy)

---

## 4. Feature Requirements

### 4.1 Customer Storefront
* **Product Discovery:**
  * Interactive grid showcasing 3D mascot artwork, base prices, category tabs, and promotional tags (`Best Seller`, `Seasonal`, `New`).
* **Interactive Drink Customizer (Modal Engine):**
  * **Temperature / Ice Level:** `100% Regular`, `70% Less Ice`, `30% Slush`, `0% No Ice` (+$0.50), `Hot`.
  * **Sweetness Level:** `100% Extra Sweet`, `75% Regular`, `50% Less Sweet`, `25% Subtle`, `0% Unsweetened`.
  * **Toppings (Max 3):** Tapioca Pearls (+$0.75), Popping Boba (+$0.85), Egg Pudding (+$0.90), Coconut Jelly (+$0.75), Signature Cheese Foam (+$1.25).
* **Two-Step Checkout Flow:**
  * **Step 1 (Fulfillment & Contact):** Toggle between *Local Delivery* and *Store Pickup*. Capture name, email, phone number, and address/pickup time slot.
  * **Step 2 (Payment & Review):** Itemized breakdown, subtotal, delivery fee, tax, and total price calculation. Supports 1-Click Express Checkout (Apple/Google Pay) and Card payments.
* **Live Order Tracking:**
  * Post-purchase page featuring a dynamic step-by-step order progress timeline:
    `Placed` -> `Brewing` -> `Out for Delivery` -> `Delivered`.
* **Community Page:**
  * Grid layout featuring approved customer reviews, ratings (1–5 stars), and uploaded photos.

### 4.2 Admin Management Workspace
* **Dashboard Overview:**
  * Real-time metrics for Total Revenue, Total Active Orders, Low Stock Items, and Customer Satisfaction Rating (98%).
* **Live Order Operations Queue:**
  * Searchable and filterable queue with status color-coding. Single-click action buttons to advance orders through states (`Advance Status` -> `Brewing` -> `Out for Delivery` -> `Completed`).
* **Inventory Control Panel:**
  * Real-time toggles for item stock availability (`In Stock` / `Out of Stock`), base price updates, and tag assignments.
* **Activity & Alerts Feed:**
  * Live log recording incoming orders, status changes, and stock warnings (triggered when stock falls below 10 units).

---

## 5. Technical Architecture & Stack

### 5.1 Technology Stack
* **Frontend:** Laravel Blade + Tailwind CSS v4.0 (utilizing `@theme` CSS tokens)
* **Backend Framework:** Laravel 11.x + Laravel Breeze (Authentication & RBAC)
* **Database:** MySQL / PostgreSQL
* **Asset Pipeline:** Vite

### 5.2 Entity Relationship Model (Database Schema Summary)

```
users (id, name, email, password, role ['customer', 'admin'], phone_number)
|-- categories (id, name, slug, is_active, sort_order)
|-- products (id, category_id, name, slug, base_price, image_path, badge_tag, is_in_stock, stock_quantity)
|-- customization_options (id, type ['ice_level', 'sugar_level', 'topping'], name, additional_price, is_available)
|-- orders (id, order_number, user_id, customer_name, customer_email, customer_phone, fulfillment_type, subtotal, tax, delivery_fee, total_amount, payment_status, status)
|   |-- order_items (id, order_id, product_id, product_name, quantity, unit_price, total_price)
|       |-- order_item_customizations (id, order_item_id, customization_option_id, option_name, option_price)
|-- testimonies (id, user_id, customer_name, rating, review_text, photo_path, is_approved)
|-- activity_logs (id, type, title, message, action_url)
```

---

## 6. CSS Theme Token Configuration (Tailwind CSS v4.0)

```css
@import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
@import "tailwindcss";

@theme {
  --font-display: "Bricolage Grotesque", system-ui, sans-serif;
  --font-sans: "Plus Jakarta Sans", system-ui, sans-serif;

  --color-lavender-500: #8a76d1;
  --color-lavender-600: #735eb8;
  --color-lavender-900: #41346b;

  --color-matcha-500: #6cae7c;
  --color-strawberry-500: #ff6b8b;

  --color-cream-50: #fdfbf7;
  --color-cream-100: #f8f4ee;
  --color-cream-200: #ede5d8;

  --radius-boba-card: 2rem;
  --radius-admin-card: 1rem;

  --shadow-boba: 0 12px 32px -8px rgba(138, 118, 209, 0.18);
}
```

---

## 7. Key Success Metrics (KPIs)
* **Checkout Conversion:** Less than 2% cart drop-off rate across the 2-step checkout flow.
* **Admin Operational Efficiency:** Order status transition time under 2 seconds per action.
* **Aesthetic Consistency:** 100% adherence to "Boba Pop" design tokens across both customer and admin interfaces.
