<?php

use Modules\AppelCRM\Contracts\Repositories\AppelRepositoryContract;
use Modules\CoreCRM\Contracts\Repositories\ClientRepositoryContract;
use Modules\CoreCRM\Contracts\Repositories\DevisRepositoryContract;
use Modules\CoreCRM\Contracts\Repositories\DossierRepositoryContract;
use App\Contracts\Repositories\TaskRepositoryContract;
use Modules\BaseCore\Contracts\Repositories\UserRepositoryContract;
use Modules\Leads\Contracts\Repositories\LeadRepositoryContract;

return [
    'display_header_active' => true,
    'repositories' => [
        UserRepositoryContract::class,
    ]

];
