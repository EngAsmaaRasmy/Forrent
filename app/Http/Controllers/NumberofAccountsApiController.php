<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Traits\SlugTrait;
use App\Traits\TranslationTrait;
use Illuminate\Support\Facades\DB;

class NumberofAccountsApiController extends Controller
{
    use ApiResponser;
    use SlugTrait;
    use TranslationTrait;

    /**
     * Show  the number of service providers.
     *
     * @return \Illuminate\Http\Response
     */
    public function numberOfAccounts()
    {
        $serviceProvider = DB::table('service_providers')->count();
        $customers = DB::table('customers')->count();
        $services = DB::table('services')->count();
        $categories = DB::table('categories')->count();
        return $this->success([
            'categories' => $categories ,
            'service_providers_accounts' => $serviceProvider ,
            'customers_accounts' => $customers,
            'services' => $services ,
        ]);
    }
}
