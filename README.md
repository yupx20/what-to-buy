<p align="center">
  <img src="https://img.shields.io/badge/What_to_Buy-Boutique_Boba_&_Milk_Tea-8a76d1?style=for-the-badge&labelColor=1e1832" alt="What to Buy">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel 13">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 8.3+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.x-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="Tailwind CSS 4">
  <img src="https://img.shields.io/badge/Vite-8.x-646CFF?style=flat-square&logo=vite&logoColor=white" alt="Vite 8">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
</p>

<p align="center">
  A vibrant, modern e-commerce platform for a boutique boba and milk tea shop.<br>
  Built with the <strong>"Boba Pop"</strong> design system — playful for customers, efficient for admins.
</p>

---

## Features

### Customer Storefront

| Feature | Description |
|---|---|
| **Product Discovery** | Interactive grid with category tabs, promotional badges (Best Seller, Seasonal, New), and base price display |
| **Drink Customizer** | Modal-based customization for ice level, sweetness, and up to 3 toppings with live price calculation |
| **Session-Based Cart** | Add, update, remove items with real-time subtotal, tax (8%), and total |
| **Two-Step Checkout** | Contact info → fulfillment (delivery/pickup) → payment method → order notes |
| **Live Order Tracking** | Dynamic timeline (`Placed → Brewing → Out for Delivery → Delivered`) with 15-second auto-polling |
| **Community Reviews** | Customer-submitted ratings and reviews with admin approval workflow |
| **Auth System** | Registration, login, logout with role-based access control |

### Admin Dashboard

| Feature | Description |
|---|---|
| **KPI Metrics** | Total revenue, active orders, low stock alerts, average rating — cached for performance |
| **Order Operations Queue** | Filterable by status, searchable, single-click status advancement |
| **Inventory Control** | Stock toggle switches, price editing, badge assignment, low-stock alerts (threshold: 10) |
| **Activity Log** | Auditable timeline of all order and inventory events, filterable by type |

---

## Design System — "Boba Pop"

| Token | Value | Usage |
|---|---|---|
| **Primary** | `#8a76d1` Soft Lavender | Buttons, links, brand elements |
| **Accent** | `#ff6b8b` Strawberry Pink | Badges, CTAs, error states |
| **Success** | `#6cae7c` Matcha Green | In-stock indicators, confirmations |
| **Surface** | `#fdfbf7` Cream Off-White | Page backgrounds |
| **Display Font** | Bricolage Grotesque | Headings, buttons, badges |
| **Body Font** | Plus Jakarta Sans | Copy, forms, data tables |

- **Customer UI**: 32px border radius, ambient shadows, micro-animations, glassmorphism navbar
- **Admin UI**: 16px border radius, high contrast, data-dense layouts

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.3+, Laravel 13 |
| **Frontend** | Blade Templates, Vanilla JavaScript |
| **Styling** | Tailwind CSS 4, Custom CSS Component Library |
| **Build Tool** | Vite 8 |
| **Database** | SQLite (dev) / MySQL or PostgreSQL (prod) |
| **Testing** | Pest PHP 5 |

---

## Project Structure

```
what-to-buy/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/AuthController.php          # Login, register, logout
│   │   │   ├── Admin/DashboardController.php     # Admin KPI dashboard
│   │   │   ├── Admin/OrderController.php         # Order queue & advancement
│   │   │   ├── Admin/ProductController.php       # Inventory management
│   │   │   ├── Admin/ActivityLogController.php   # Audit log viewer
│   │   │   ├── StorefrontController.php          # Home, menu, product pages
│   │   │   ├── CartController.php                # Cart CRUD operations
│   │   │   ├── CheckoutController.php            # Checkout flow
│   │   │   ├── OrderTrackingController.php       # Order tracking & status API
│   │   │   └── CommunityController.php           # Reviews & testimonies
│   │   ├── Middleware/
│   │   │   └── EnsureUserIsAdmin.php             # Admin route guard
│   │   └── Requests/                             # 4 Form Request validators
│   ├── Models/                                   # 9 Eloquent models
│   ├── Providers/
│   │   └── AppServiceProvider.php                # CartService singleton
│   └── Services/
│       ├── CartService.php                       # Session-based cart logic
│       ├── OrderService.php                      # Order creation & status pipeline
│       ├── InventoryService.php                  # Stock management
│       ├── DashboardService.php                  # Cached KPI metrics
│       └── ActivityLogService.php                # Audit trail
├── database/
│   ├── migrations/                               # 11 migration files
│   └── seeders/                                  # 5 seeders (users, products, etc.)
├── resources/
│   ├── css/app.css                               # Boba Pop design system
│   ├── js/app.js                                 # Client-side interactivity
│   └── views/
│       ├── layouts/                              # Storefront & admin layouts
│       ├── components/                           # Reusable Blade components
│       ├── storefront/                           # 7 customer-facing pages
│       ├── auth/                                 # Login & register pages
│       └── admin/                                # 5 admin pages
├── routes/web.php                                # 31 route definitions
└── PRD.md                                        # Product Requirements Document
```

---

## Getting Started

### Prerequisites

- **PHP** ≥ 8.3 with extensions: `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`
- **Composer** ≥ 2.x
- **Node.js** ≥ 18.x with npm

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-username/what-to-buy.git
cd what-to-buy

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Create database & seed demo data
touch database/database.sqlite   # Only for SQLite
php artisan migrate --seed

# 6. Create storage symlink (for uploaded images)
php artisan storage:link

# 7. Build frontend assets
npm run build
```

### Running Locally

```bash
# Option A: Using composer dev script (starts server, queue, and Vite simultaneously)
composer dev

# Option B: Manual start
php artisan serve        # Backend at http://localhost:8000
npm run dev              # Vite HMR at http://localhost:5173
```

Visit **http://localhost:8000** to see the storefront.

---

## Demo Accounts

| Role | Email | Password |
|---|---|---|
| **Admin** | `admin@whattobuy.com` | `password` |
| **Customer** | `customer@whattobuy.com` | `password` |

> The admin account has access to the admin dashboard at `/admin`.

---

## Seeded Demo Data

| Entity | Count | Details |
|---|---|---|
| Users | 2 | 1 admin, 1 customer |
| Categories | 4 | Classic Milk Tea, Fruit Tea, Specialty, Seasonal Specials |
| Products | 12 | 3 per category, with promotional badges |
| Customization Options | 15 | 5 ice levels, 5 sugar levels, 5 toppings |
| Testimonies | 8 | Pre-approved 4–5 star reviews |

---

## Route Map

### Customer Routes

| Method | URI | Name | Description |
|---|---|---|---|
| `GET` | `/` | `home` | Landing page with featured products |
| `GET` | `/menu` | `menu` | Full product catalog with category filter |
| `GET` | `/menu/{product:slug}` | `product.show` | Individual product page (SEO) |
| `GET` | `/cart` | `cart.index` | Shopping cart |
| `POST` | `/cart/add` | `cart.add` | Add item to cart (AJAX) |
| `PATCH` | `/cart/{i}` | `cart.update` | Update cart item quantity |
| `DELETE` | `/cart/{i}` | `cart.remove` | Remove cart item |
| `GET` | `/checkout` | `checkout.index` | Checkout form |
| `POST` | `/checkout/place` | `checkout.store` | Place order |
| `GET` | `/track/{orderNumber}` | `order.track` | Order tracking page |
| `GET` | `/track/{orderNumber}/status` | `order.status` | Order status (JSON/AJAX) |
| `GET` | `/community` | `community` | Community reviews |
| `POST` | `/community` | `community.store` | Submit a review (auth) |

### Auth Routes

| Method | URI | Name | Description |
|---|---|---|---|
| `GET` | `/login` | `login` | Login form |
| `POST` | `/login` | — | Process login |
| `GET` | `/register` | `register` | Registration form |
| `POST` | `/register` | — | Process registration |
| `POST` | `/logout` | `logout` | Logout (auth) |

### Admin Routes (requires `auth` + `admin` middleware)

| Method | URI | Name | Description |
|---|---|---|---|
| `GET` | `/admin` | `admin.dashboard` | KPI dashboard |
| `GET` | `/admin/orders` | `admin.orders.index` | Order queue |
| `GET` | `/admin/orders/{order}` | `admin.orders.show` | Order detail |
| `PATCH` | `/admin/orders/{order}/advance` | `admin.orders.advance` | Advance order status |
| `GET` | `/admin/products` | `admin.products.index` | Product inventory |
| `GET` | `/admin/products/{product}/edit` | `admin.products.edit` | Edit product form |
| `PUT` | `/admin/products/{product}` | `admin.products.update` | Save product changes |
| `PATCH` | `/admin/products/{product}/toggle-stock` | `admin.products.toggle-stock` | Toggle stock availability |
| `GET` | `/admin/activity` | `admin.activity` | Activity audit log |

---

## Architecture Decisions

### Service Layer Pattern
Business logic is encapsulated in `app/Services/`, not controllers. Controllers handle HTTP concerns only (request parsing, response formatting). This keeps controllers thin and logic reusable.

### Session-Based Cart
The cart uses Laravel's session store rather than a database table. This allows guest checkout without requiring authentication, while keeping the cart stateless and horizontally scalable (with Redis session driver).

### Order Status Pipeline
Orders follow a strict status pipeline defined as a PHP constant:

```
placed → brewing → out_for_delivery → delivered → completed
```

Status can only be advanced forward (never backward), enforced by the `OrderService::advanceOrderStatus()` method.

### Simulated Payment
Payment is simulated with a `processPayment()` stub that always returns `paid`. The architecture is designed for drop-in replacement with Stripe, PayPal, or any payment gateway — just implement the interface in `OrderService`.

### Dashboard Caching
KPI metrics are cached for 5 minutes via `DashboardService::getMetrics()`. Cache is invalidated when orders are advanced.

---

## Deployment Guide

### Environment Variables

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql           # or pgsql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=what_to_buy
DB_USERNAME=your_user
DB_PASSWORD=your_password

SESSION_DRIVER=redis          # Recommended for production
CACHE_STORE=redis
QUEUE_CONNECTION=redis
```

### Production Commands

```bash
# Install dependencies (no dev packages)
composer install --optimize-autoloader --no-dev
npm ci && npm run build

# Run migrations
php artisan migrate --force

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Storage link
php artisan storage:link
```

### Scaling Considerations

- **Database**: Use MySQL 8+ or PostgreSQL 15+ with read replicas for high traffic
- **Sessions**: Use Redis to enable horizontal scaling across multiple servers
- **File Storage**: Use S3 or similar cloud storage for product images (`FILESYSTEM_DISK=s3`)
- **Queue**: Use Redis + Horizon for background job processing (email notifications, etc.)
- **CDN**: Put a CDN (CloudFront, Cloudflare) in front of static assets

---

## Testing

```bash
# Run the test suite
php artisan test

# Or with Pest directly
./vendor/bin/pest
```

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
