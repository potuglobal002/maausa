# MAA Website

Fresh Laravel 12 website for Mothers for Advocacy & Awareness.

## Stack

- Laravel 12 and PHP 8.2
- MySQL (`maausadb` locally)
- Blade, Tailwind CSS, Alpine.js and Vite
- Selective Livewire components will be introduced for CMS workflows, filters and registrations

## Local development

1. Copy `.env.example` to `.env` and keep the local database credentials private.
2. Create an empty MySQL database named `maausadb`.
3. Run `composer install` and `npm install` when package registry access is available.
4. Run `php artisan key:generate` and `php artisan migrate`.
5. Start the frontend with `npm run dev` and Laravel with `php artisan serve`.

The existing MAA website is a reference for approved content and original media. New content is managed by this application and its fresh schema.

Planning documents and the approved landing-page reference are in [`development`](development/).
