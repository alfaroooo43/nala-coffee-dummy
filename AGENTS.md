# NALA COFFEE DUMMY — CODEX PROJECT RULES

## PRIMARY OBJECTIVE

Develop the Nala Coffee Dummy website using Laravel.

The project is a dummy/company-profile project for development and learning purposes.

The website may use https://nalacoffee.id/ as a visual and structural reference.

The reference website is NOT the source code of this project.

PRINCIPLE:

PRESERVE → EXTEND → INTEGRATE → TEST

Once a design or component has been implemented and approved,
treat it as the new baseline.

Never rebuild an existing implementation unless explicitly instructed.

---

# 1. PROJECT TECHNOLOGY

The project uses:

- Laravel 13
- PHP
- Blade
- HTML5
- CSS3
- JavaScript
- Bootstrap 5
- Vite
- MySQL

Bootstrap 5 is the primary CSS framework.

JavaScript is allowed.

Do not introduce:

- React
- Vue
- Angular
- Next.js
- Nuxt
- Tailwind as the primary CSS framework

Do not replace Laravel with another framework.

---

# 2. DESIGN PROTECTION

After a landing page section has been implemented and approved,
its design becomes LOCKED.

Do not modify without explicit instruction:

- colors
- typography
- fonts
- spacing
- layout
- navbar
- hero
- sections
- cards
- footer
- images
- animations
- hover effects
- responsive behavior
- existing content

Do not redesign existing components.

Do not replace existing components with completely different
implementations unless explicitly requested.

New features must visually integrate with the existing design.

---

# 3. MINIMAL CHANGE PRINCIPLE

Before modifying any existing file:

1. Read the file.
2. Understand its purpose.
3. Identify dependencies.
4. Identify the smallest required change.
5. Modify only the necessary part.

Never rewrite an entire file when only a small modification is required.

---

# 4. NEVER USE GLOBAL CSS CHANGES FOR NEW FEATURES

Avoid modifying global selectors when creating new functionality.

Avoid unnecessary changes to:

- body
- h1
- h2
- h3
- button
- a
- section
- .container
- .card
- .table

Prefer feature-specific classes.

Example:

.admin-sidebar
.admin-dashboard
.admin-product-table
.admin-product-form

instead of generic classes such as:

.sidebar
.card
.table
.button

---

# 5. LANDING PAGE

The public landing page will contain:

- Navbar
- Hero
- About
- Products
- Process
- Gallery
- Social Media
- Contact
- Footer

The landing page should be:

- clean
- modern
- premium
- responsive
- coffee-brand oriented

Do not make the design look like default Bootstrap.

Use Bootstrap for layout and responsive behavior,
then use custom CSS for branding and visual identity.

---

# 6. PRODUCT SHOWCASE

The landing page must eventually display:

- product image
- product name
- product description
- product price
- Shopee purchase button

Products should eventually be loaded from the Laravel database.

Do not hardcode production product data once the database system is implemented.

The Shopee button must open the configured Shopee URL.

Use:

target="_blank"

and:

rel="noopener noreferrer"

---

# 7. SOCIAL MEDIA

The website supports:

- Instagram
- TikTok

Social media links should eventually be manageable through the admin system.

Do not invent URLs that appear to be official accounts.

Use dummy URLs when real URLs have not been provided.

---

# 8. ADMIN PANEL

The admin panel must be logically separated from the public landing page.

Expected structure:

Public:

/
 /products
 /about
 /contact

Admin:

/admin
/admin/login
/admin/dashboard
/admin/products
/admin/gallery
/admin/messages
/admin/settings

Additional admin modules may be added when explicitly requested.

Admin functionality must not unintentionally alter the existing landing page design.

---

# 9. MVC ARCHITECTURE

Use Laravel MVC conventions.

Model
→ Database/data logic

Controller
→ Application/business logic

View
→ UI/presentation

Do not place SQL queries directly inside Blade.

Do not place large business logic inside Blade templates.

Do not mix database logic with presentation code.

Use Eloquent whenever appropriate.

---

# 10. LARAVEL

Use Laravel conventions:

- Routes
- Controllers
- Models
- Eloquent
- Blade
- Middleware
- Form Requests when appropriate
- Migrations
- Seeders
- Validation

Do not replace Laravel with custom PHP architecture.

Do not introduce another backend framework.

---

# 11. DATABASE

Before creating database functionality:

1. Inspect existing migrations.
2. Inspect existing models.
3. Inspect existing database structure.
4. Reuse existing tables where appropriate.
5. Avoid duplicate tables.

Use migrations for schema changes.

Use seeders for dummy data.

Do not manually modify database structure when a migration should be used.

---

# 12. PRODUCT DATABASE

The product system should use a Laravel database table.

Minimum product fields:

- id
- name
- slug
- image
- description
- price
- shopee_url
- is_active
- created_at
- updated_at

Prices must be stored numerically.

Display prices using Indonesian Rupiah formatting.

Example:

Rp85.000

---

# 13. CRUD

Admin CRUD should support:

Create
Read
Update
Delete

Every CRUD must consider:

- validation
- authorization
- error handling
- success feedback
- delete confirmation
- secure input handling

---

# 14. AUTHENTICATION

Admin pages must require authentication.

Protect admin routes using appropriate Laravel authentication middleware.

Never expose admin functionality publicly.

Passwords must never be stored as plaintext.

---

# 15. SECURITY

Always consider:

- CSRF
- XSS
- SQL injection
- authentication
- authorization
- file upload validation
- input validation
- session security

Use Laravel's built-in security mechanisms whenever available.

Do not implement unnecessary custom security systems.

---

# 16. RESPONSIVE DESIGN

The website must work correctly on:

- Desktop
- Tablet
- Mobile

New features must not break existing responsive behavior.

Check:

- navbar
- hero
- product cards
- gallery
- buttons
- typography
- images
- footer
- admin pages

Avoid horizontal overflow.

---

# 17. JAVASCRIPT

JavaScript is allowed.

Use JavaScript for functionality such as:

- navbar interactions
- scroll effects
- smooth scrolling
- gallery interaction
- product interaction
- modal
- image preview
- animations
- form interactions

Do not introduce unnecessary JavaScript.

Do not remove existing JavaScript without a valid reason.

Prefer existing project patterns.

---

# 18. BOOTSTRAP

Use Bootstrap 5 for:

- Grid
- Container
- Row
- Column
- Navbar
- Card
- Button
- Modal
- Form
- Table
- Alert
- Badge
- Responsive utilities

Custom CSS is allowed.

Do not override Bootstrap globally unless necessary.

---

# 19. ASSETS

Do not delete or replace existing:

- images
- fonts
- CSS
- JavaScript
- icons
- components

unless explicitly instructed.

Do not rename existing assets unnecessarily.

For dummy assets, use:

- local assets
- placeholders
- assets that are permitted to be used

---

# 20. BLADE STRUCTURE

Use modular Blade architecture.

Preferred structure:

resources/views/

    layouts/
        app.blade.php

    partials/
        navbar.blade.php
        hero.blade.php
        about.blade.php
        products.blade.php
        process.blade.php
        gallery.blade.php
        social-media.blade.php
        contact.blade.php
        footer.blade.php

    home.blade.php

Do not put the entire website into one unnecessarily large Blade file.

---

# 21. BEFORE CODING

Before implementing a new feature:

1. Inspect project structure.
2. Identify framework.
3. Identify Laravel version.
4. Identify routes.
5. Identify controllers.
6. Identify models.
7. Identify views.
8. Identify database.
9. Identify CSS.
10. Identify JavaScript.
11. Identify Bootstrap/Vite configuration.
12. Determine the smallest safe implementation.

Do not start by rebuilding the project.

---

# 22. WHEN UNCERTAIN

If you do not understand a file:

DO NOT DELETE IT.

If you do not understand a dependency:

DO NOT REMOVE IT.

If you are unsure whether a change affects existing design:

DO NOT make the global change.

Inspect first.

---

# 23. NO UNAUTHORIZED REFACTOR

Do not perform large refactors simply because another architecture
may appear cleaner.

If a large refactor is genuinely required:

1. Explain the technical reason.
2. Identify affected files.
3. Minimize the scope of changes.
4. Preserve existing functionality.

---

# 24. TESTING

After every significant change, verify:

- Landing page
- Navbar
- Hero
- About
- Products
- Process
- Gallery
- Social Media
- Contact
- Footer

Then verify:

- Desktop
- Tablet
- Mobile

For backend features also verify:

- Authentication
- Authorization
- CRUD
- Database
- Validation
- Image upload

Use appropriate Laravel commands such as:

php artisan route:list

---

# 25. CHANGE REPORT

After completing a task, report:

### Files modified
List every modified file.

### Files created
List every new file.

### Database changes
List migrations/tables/columns changed.

### Features added
List implemented features.

### Existing UI impact
Explain whether the existing landing page design was changed.

### Testing
List what was tested.

---

# 26. CURRENT PROJECT STATUS

Laravel project has already been created successfully.

Current environment:

- Laravel 13.32.0
- Bootstrap 5.3.8
- @popperjs/core 2.11.8
- Vite 8.3.0
- JavaScript
- CSS
- Blade
- PHP

Bootstrap and Vite are already installed.

DO NOT:

- reinstall Laravel
- create another Laravel project
- delete node_modules
- delete vendor
- replace Laravel
- replace Bootstrap
- replace Vite

---

# 27. TASK SCOPE

Follow the exact scope provided by the user.

If the user asks to:

"Add product section"

Do not automatically:

- create admin dashboard
- create authentication
- redesign the entire website
- change unrelated database structures
- refactor unrelated files

Only implement what is required.

---

# 28. FINAL RULE

DO NOT BREAK THE NALA COFFEE DUMMY PROJECT.

Once a section is implemented and approved,
it becomes the new source of truth.

Do not redesign it without explicit instruction.

Do not change colors without instruction.

Do not change typography without instruction.

Do not change layout without instruction.

Do not remove sections without instruction.

Do not replace components without instruction.

Do not migrate frameworks.

Do not rebuild the project.

Only extend the system when explicitly requested.

PRINCIPLE:

PRESERVE → EXTEND → INTEGRATE → TEST

===

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application running on PHP 8.3. You are an expert with the Laravel ecosystem. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists (settled decisions, non-obvious traps, standing constraints). Framework and package guidelines that only apply to specific paths (testing, frontend, components) also live there, under `.ai/rules/boost` — this is not just recorded decisions, it is load-bearing guidance you have not seen inline. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.
- Activate the `deploying-to-cloud` skill whenever deploying to Laravel Cloud, configuring Cloud environments or resources, using the Cloud CLI, or troubleshooting Cloud deployments.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This project uses PHPUnit. Create tests with `php artisan make:test --phpunit {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/phpunit` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

</laravel-boost-guidelines>
