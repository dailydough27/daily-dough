# Daily Dough — Ordering Website v1

A Laravel 12 + Inertia 2 + Vue 3 + Tailwind 4 ordering website for Daily Dough.

## Customer flow
- Premium cream/brown storefront
- Menu for the six flavors
- Build a box: 4 / 6 / 12 cookies
- Session cart
- Delivery-zone selection
- Coupon support
- Cash on delivery checkout
- Order confirmation
- Public order tracking at `/track/{orderNumber}`

## Admin
- Password-protected admin area
- Dashboard and revenue/order stats
- Search/filter orders
- Order details and status workflow
- Products/flavors management
- Box sizes and prices
- Delivery zones and fees
- Coupons
- Store/brand settings

## Stack
- Laravel 12
- Inertia 2
- Vue 3
- Tailwind CSS 4 + Vite
- MySQL

## Setup
1. Install PHP 8.2+, Composer, Node 20+, and MySQL.
2. `composer install`
3. `cp .env.example .env`
4. Create a MySQL database named `daily_dough` or change `.env`.
5. `php artisan key:generate`
6. `php artisan migrate --seed`
7. `npm install`
8. `npm run dev`
9. In another terminal: `php artisan serve`

Store: `http://127.0.0.1:8000`
Admin: `http://127.0.0.1:8000/admin/login`

Set `DAILY_DOUGH_ADMIN_PASSWORD` in `.env` before using the admin.

## Seed data
- Classic Chocolate Chip
- Double Chocolate
- Pistachio
- Lotus
- Red Velvet
- Kinder
- Box of 4 / 6 / 12
- Cairo / Giza / 6 October delivery zones

Seed prices and delivery fees are placeholders and are intended to be changed from the admin/store settings.

## Before production
- Replace placeholder product images with real Daily Dough photography.
- Replace the simple admin password session with full Laravel authentication + 2FA/authorization.
- Add rate limiting and production logging/monitoring.
- Add online payments.
- Add WhatsApp/SMS/email notifications.
- Add privacy, terms, refund and delivery policies.
- Add analytics and SEO metadata.
