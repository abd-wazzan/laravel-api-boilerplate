<p align="center">
<img src="https://user-images.githubusercontent.com/46269541/230351628-f3eb6682-3799-42d9-8e7a-9ab918906f2e.png" alt="Laravel API Boilerplate">
</p>
<p align="center">
  A <a href="https://laravel.com" target="_blank">Laravel</a> project with a Domain-Driven Design (DDD) structure, basic configuration, and commonly used packages pre-installed  and configured, to help you start building your next big application.
</p>

# Requirements
- PHP ^8.1
- Composer ^2.2

# Installation
```bash
composer create-project abd-wazzan/laravel-api-boilerplate api-app
```
Install dependencies
```bash
cd api-app
composer install
```
Setup .env file
```bash
cp .env.example .env
```
Generate the application key
```bash
php artisan key:generate 
```
Run Locally
```bash
php artisan serve
```
# Installed Packages

General:
- [Passport](https://laravel.com/docs/10.x/passport)
- [Laravel Actions](https://laravelactions.com)
- [Laravel Data](https://spatie.be/docs/laravel-data/v3/introduction)
- [Laravel Query Builder](https://spatie.be/index.php/docs/laravel-query-builder/v5/introduction)

Development:
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Scribe API documentation tool](https://scribe.knuckles.wtf/laravel)
- [Laravel Telescope](https://laravel.com/docs/10.x/telescope)
- [Pest Testing Framework](https://pestphp.com/)
- [Grum PHP](https://github.com/phpro/grumphp)
- [Security Advisor](https://github.com/Roave/SecurityAdvisories)

# Features
- [DDD (Domain Driven Design)](#ddd)
- [API Response Helper](#api-response-helper)
- [Scribe Api Tags](#scribe-api-tags)
- [Global Helper](#global-helper)
- [Migration Structure](#migration-structure)
- [Polymorphic Mapping](#polymorphic-mapping)
- [Database Seeders](#database-seeders)
- [Shared Directory](#shared-directory)
- [Enable Model Strict Mode](https://laravel.com/docs/10.x/eloquent#configuring-eloquent-strictness)
- [Pest testing framework](https://pestphp.com/docs/installation)

## DDD
Software development approach that tries to bring the business language and the source code as close as possible.

This structure is inspired by [LARAVEL BEYOND CRUD](https://laravel-beyond-crud.com/).

### Files Structure
Domain Layer Example:

    src/Domain/Invoices/
    ├── Actions
    ├── QueryBuilders
    ├── Collections
    ├── Data
    ├── Events
    ├── Exceptions
    ├── Listeners
    ├── Models
    ├── Rules
    └── States
    src/Domain/Products/
    ├── Actions
    └── .....

Application Layer Example:

    The REST API application:
    src/App/Api/
    ├── Products
        ├── Controllers
        ├── Middlewares
        ├── Requests
        ├── Queries
        ├── Filters
        └── Resources

    The Console application
    src/App/Console/
    └── Commands

    The admin HTTP application:
    src/App/Admin/
    ├── Products
        ├── Controllers
        ├── Middlewares
        ├── Requests
        ├── Resources
        ├── Queries
        ├── Filters
        └── ViewModels

### Dependency Illustration
[![](https://mermaid.ink/img/pako:eNptkV9PwjAUxb9KcxMSTAZh_xjswQRWfJKggC8yHup2lcVtnV2XiJTvbulEMPGtved3em7vPUDCU4QQ3gSrdmRN45IQMtk81Si2pNe7VUv8aLCWiky7ES-l4HmOgkwSmfHyxtBTw9H1QpGoS3nBsvKPHhn9gQlWoEShCO3OdWjeqvSkErV6vCd1IrJKJ802lEn2wmrcGmTWIo8Nij0RWDe5hui1e_lTjC6BRC0qFOzUxq9neunXeCpe1qjI5NrV_sNUOp0ze4cy2RHTgKJnjf7Tlk4ACwoUegqpHuvhBMcgd1hgDKE-pky8xxCXR82xRvLVvkwglKJBC5oqZRJpxvQ2CghfWV7rKqaZ5GLe7smsy4KKlc-cF2ejvkJ4gE8IHc_v-844GNuuZ49tx3Yt2EM4CvqeF7gjNxgNfN-xg6MFX-aBQX_oBY4_9H3XDtzB0HeO333zodw?type=png)](https://mermaid.live/edit#pako:eNptkV9PwjAUxb9KcxMSTAZh_xjswQRWfJKggC8yHup2lcVtnV2XiJTvbulEMPGtved3em7vPUDCU4QQ3gSrdmRN45IQMtk81Si2pNe7VUv8aLCWiky7ES-l4HmOgkwSmfHyxtBTw9H1QpGoS3nBsvKPHhn9gQlWoEShCO3OdWjeqvSkErV6vCd1IrJKJ802lEn2wmrcGmTWIo8Nij0RWDe5hui1e_lTjC6BRC0qFOzUxq9neunXeCpe1qjI5NrV_sNUOp0ze4cy2RHTgKJnjf7Tlk4ACwoUegqpHuvhBMcgd1hgDKE-pky8xxCXR82xRvLVvkwglKJBC5oqZRJpxvQ2CghfWV7rKqaZ5GLe7smsy4KKlc-cF2ejvkJ4gE8IHc_v-844GNuuZ49tx3Yt2EM4CvqeF7gjNxgNfN-xg6MFX-aBQX_oBY4_9H3XDtzB0HeO333zodw)

### Resources
- [Domain Oriented Laravel](https://stitcher.io/blog/laravel-beyond-crud-01-domain-oriented-laravel)
- [Working With Data](https://stitcher.io/blog/laravel-beyond-crud-02-working-with-data)
- [Actions](https://stitcher.io/blog/laravel-beyond-crud-03-actions)
- [Models](https://stitcher.io/blog/laravel-beyond-crud-04-models)
- [States](https://stitcher.io/blog/laravel-beyond-crud-05-states)
- [Managing Domains](https://stitcher.io/blog/laravel-beyond-crud-06-managing-domains)
- [Application Layer](https://stitcher.io/blog/laravel-beyond-crud-07-entering-the-application-layer)
- [View Models](https://stitcher.io/blog/laravel-beyond-crud-08-view-models)
- [Test Factories](https://stitcher.io/blog/laravel-beyond-crud-09-test-factories)

## API Response Helper
A simple trait allowing consistent API responses throughout your Laravel application.

### Available methods:
| Method                    | Status |
|:--------------------------|:-------|
| `okResponse()`            | `200`  |
| `createdResponse()`       | `201`  |
| `failedResponse()`        | `400`  |
| `unauthorizedResponse()`  | `401`  |
| `forbiddenResponse()`     | `403`  |
| `notFoundResponse()`      | `404`  |
| `unprocessableResponse()` | `422`  |
| `serverErrorResponse()`   | `500`  |

### Usages Example:
```php
<?php

namespace App\Http\Api\Controllers;

use App\Traits\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Controller;

class ProductController extends Controller
{
    use ApiResponseHelper;

    public function index(): JsonResponse
    {
        return $this->okResponse();
    }
}
```
## Scribe Api Tags
Additional scribe tags that match the ApiResponseHelper responses.

### Available Response tags:
| Tag                      | Status |
|:-------------------------|:-------|
| `@okResponse`            | `200`  |
| `@createdResponse`       | `201`  |
| `@failedResponse`        | `400`  |
| `@unauthorizedResponse`  | `401`  |
| `@forbiddenResponse`     | `403`  |
| `@notFoundResponse`      | `404`  |
| `@unprocessableResponse` | `422`  |
| `@serverErrorResponse`   | `500`  |

### Other Available tag:
| Tag               | Description                                                      |
|:------------------|:-----------------------------------------------------------------|
| `@usesPagination` | will add `page[number]` and `page[size]` to the query parameters |

### Usages Example:
```php
<?php

namespace App\Http\Api\Controllers;

use App\Helpers\ApiController;
use App\Traits\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use App\Http\Controller;

/**
 * Class CategoryController
 * @group Category
 */
class CategoryController extends Controller
{
    use ApiResponseHelper;

    /**
     * Get Categories
     *
     * this request is used to get all categories.
     *
     * @queryParam filter[name]
     *
     * @usesPagination
     * @failedResponse
     * @forbiddenResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     */
    public function index(): Response
    {
        return CategoryResource::collection($categories->all());
    }

}
```

## Global Helper
Simple php file that contains you global functions, which you can find it in `./src/shared/Helpers/global.php`.

## Migration Structure
In order to group your migration files by their domains, you can create additional migration directories
and load them in the `AppServiceProvider` using `loadMigrationsFrom` function:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom([
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Client',
        ]);
    }
}
```

## Polymorphic Mapping
Please read this [article](https://laravel-news.com/enforcing-morph-maps-in-laravel) first to identify the problem.

In order to achieve the morph mapping, we created the `MorphEnum` that will contain each model morph key and then use it
in `Relation::morphMap` function as shown in the example:
```php
<?php

namespace Shared\Enums;

enum MorphEnum: string
{
    case USER = 'user';
}
```

```php
<?php

namespace App\Providers;

use Shared\Enums\MorphEnum;
use Domain\Client\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            MorphEnum::USER->value => User::class,
        ]);
    }
}
```

## Database Seeders
We generally have two types of seeded data:

- Initial data: the project cannot function without it. For example, countries table data, and these data usually come
  from datasets.
- Fake data: for testing purposes that can fill up any table instead of manually inserting row by row, this data is
  usually generated by factories.

In order to prevent the fake data from being seeded in the production environment, we created a new seeder class
called `TestingSeeder.php` which will contain all the fake data seeders and will only run in a non-production
environment. The normal seeders will stay in `DatabaseSeeder.php`.

## Shared Directory
The `src/shared/` directory is used for helper, traits, enums .... that are going to be used by the application and the domain.

# Feedback
I will be happy to hear your feedback! If you have any recommendation or suggestion, please send an e-mail
to [Mail](mailto:abdulrahmanwazzan.pro@gmail.com).
