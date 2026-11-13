# LCanteen

**An ongoing personal project for learning Laravel and Livewire by building a canteen catalog.**

I'm building LCanteen to learn how Laravel and Livewire work together in a real application. The canteen theme gives me a practical way to explore database relationships, reusable components, page navigation, and displaying data in an interactive interface.

**This project is still in progress.** Features, structure, and implementation choices will change as I learn. The current application is an early catalog-browsing experience, and the repository reflects that learning process rather than a finished canteen management system.

## Why I'm building this

My main goal is to become more comfortable building applications with Laravel and Livewire. Through this project, I'm practicing:

- Structuring a Laravel application and defining named routes.
- Designing database tables with migrations.
- Working with Eloquent models and relationships.
- Generating sample data with factories and seeders.
- Building Livewire single-file components with PHP and Blade.
- Reusing components across multiple pages.
- Displaying paginated data and navigating with `wire:navigate`.
- Using Flux UI components and Tailwind CSS to build the interface.
- Gradually improving code quality through tests, formatting, and static analysis.

Some parts are experiments, and some still need refinement. Improving the implementation as I understand the framework better is part of the purpose of the project.

## Current features

### Categories

- Browse categories in a paginated table, with five categories per page.
- View category descriptions and the number of products in each category.
- Open a category to browse its products.

### Products

- Browse all products in a paginated table, with fifteen products per page.
- See each product's name, category, description, price, and stock.
- Follow links between products, their categories, and their detail pages.
- Reuse the same product-list component for the full catalog and category-specific listings.

### Product details

- View a product's name, calories, and ingredients.
- Display a fallback message when nutritional details are missing.

### Interface

- Shared application layout built with Flux UI.
- Sidebar navigation for categories and products.
- Mobile sidebar controls and dark-mode styling.
- Livewire navigation between catalog pages.

## Work in progress

The current scope is browsing catalog data. Creating, editing, and deleting records through the UI, ordering, checkout, and payments are not implemented.

Some visible interface elements are still placeholders: the sidebar search, Settings and Help links, and demo profile/account controls do not yet provide complete application functionality. A user model exists, but the current application routes do not include login or registration pages.

Automated test coverage is also at an early stage. The repository currently contains a basic homepage response test and an example unit test; detailed coverage of catalog behavior is still to be developed.

There is no fixed release schedule. The project will continue to evolve as I learn and decide what to build next.

## Technology stack

| Area | Technology |
| --- | --- |
| Backend | Laravel 13 |
| Reactive components | Livewire 4 |
| Templates | Blade and Livewire single-file components |
| UI components | Flux UI 2 |
| Styling | Tailwind CSS 4 |
| Frontend tooling | Vite Plus, using the `vp` commands |
| Default database | SQLite |
| Sample data | Eloquent factories and Faker |
| Testing | Pest 5 |
| Formatting | Laravel Pint |
| Static analysis | Larastan / PHPStan |

The project is developed with PHP 8.5. See `composer.json`, `composer.lock`, and `package.json` for dependency constraints and locked PHP package versions.

## Running locally

### Requirements

- PHP 8.5, matching the project's development environment, with the extensions required by Composer and SQLite support.
- Composer.
- Node.js compatible with Vite Plus: `^22.18.0`, `^24.11.0`, or `>=26.0.0`.
- npm.
- Git, if cloning the repository.

### 1. Get the source

Clone this repository using its Git clone URL, then open the project directory:

```bash
cd LCanteen
```

### 2. Install PHP dependencies and configure the environment

```bash
composer install
cp .env.example .env
php artisan key:generate --no-interaction
```

In `.env`, set the application name:

```dotenv
APP_NAME=LCanteen
DB_CONNECTION=sqlite
```

SQLite is the default database. Sessions, cache, and queues also use the database by default, with their supporting tables provided by the migrations. An external database server is not needed for this setup.

### 3. Prepare the database

On a Unix-like system, create the SQLite file if it does not already exist:

```bash
touch database/database.sqlite
php artisan migrate --no-interaction
```

To populate the catalog with generated sample data:

```bash
php artisan db:seed --no-interaction
```

The main seeder creates ten categories, each with ten products, and a detail record for every product: 100 products and 100 detail records in total. The generated names and descriptions are development data rather than a curated canteen menu. Running the seeder again adds more records.

### 4. Install and build frontend assets

```bash
npm install
npm run build
```

### 5. Start development

The project includes a development command:

```bash
composer run dev
```

Open the application address printed by the development server. The homepage displays the category catalog.

Alternatively, run the application server and frontend development server in separate terminals:

```bash
php artisan serve --no-interaction
```

```bash
npm run dev
```

### Setup shortcut

The repository also provides `composer run setup`. It installs PHP dependencies, creates `.env` if needed, generates an application key, runs migrations, installs npm dependencies, and builds frontend assets. Make sure the SQLite file exists first. Sample data still needs to be seeded separately.

## Application pages

| Path | Named route | Purpose |
| --- | --- | --- |
| `/` | `categories.index` | Browse categories |
| `/categories/{category}` | `categories.show` | Browse products in a category |
| `/products/index` | `products.index` | Browse all products |
| `/details/{product}` | `details.show` | View a product's calories and ingredients |

These pages are registered as full-page Livewire components in `routes/web.php`.

## Data model

The catalog is built around three models:

| Model | Main data | Relationships |
| --- | --- | --- |
| `Category` | Name and optional description | Has many products |
| `Product` | Name, optional description, price, stock, category | Belongs to a category; has one detail record |
| `Detail` | Calories and ingredients | Belongs to a product |

The ingredients column is currently spelled `ingridients` in the database, factory, model, and view. This is the existing implementation spelling; the interface displays the label “Ingredients.”

## Project structure

```text
app/
  Models/                    Eloquent models and relationships
database/
  factories/                 Generated sample-data definitions
  migrations/                Catalog and framework table definitions
  seeders/                   Database seeders
resources/
  css/                       Application styles
  js/                        Frontend entry point
  views/
    components/products/     Reusable Livewire product list
    layouts/                 Shared application layout
    pages/categories/        Category listing and category products
    pages/products/          Full product catalog
    pages/details/           Product detail page
routes/
  web.php                    Application page routes
tests/
  Feature/                   HTTP/application tests
  Unit/                      Unit tests
```

Livewire component filenames use the `⚡` prefix. The single-file components keep their PHP behavior and Blade markup in the same file.

## Development checks

Run the test suite:

```bash
php artisan test --compact
```

Feature tests are configured to use an in-memory SQLite database with the `RefreshDatabase` trait.

Run static analysis:

```bash
composer run types:check
```

Format PHP code:

```bash
composer run lint
```

Run the combined checks:

```bash
composer run test
```

The combined script clears the configuration cache, checks formatting, runs static analysis, and then runs the tests. These tools are available to support development; their presence does not imply that the application has comprehensive test coverage or that every check currently passes.

## Troubleshooting

- **Empty catalog:** Run `php artisan db:seed --no-interaction` to add sample records.
- **Missing database tables:** Check the SQLite file and run `php artisan migrate --no-interaction`.
- **Missing application key:** Run `php artisan key:generate --no-interaction` after creating `.env`.
- **Missing Vite manifest or assets:** Run `npm run build`, or keep `npm run dev` running during development.
- **Environment changes are not reflected:** Run `php artisan config:clear --no-interaction`.

## Learning and feedback

LCanteen is a place for me to learn by building, making mistakes, and improving the code over time. Suggestions that explain the reasoning behind a Laravel or Livewire approach are especially useful. Expect unfinished pieces and changes as development continues.
