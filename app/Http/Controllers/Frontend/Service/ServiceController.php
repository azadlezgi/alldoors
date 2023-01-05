<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    public function index(Request $request)
    {


        $services = Service::select(
            'services.id as id',
            'services_translations.name as name',
            'services_translations.text as text',
            'services.image as image',
            'services.slug as slug',
            'services.status as status',
            'services.created_at as created_at',
        )
            ->where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('services_translations', 'services.id', '=', 'services_translations.service_id')
            ->orderBy('id', 'DESC')
            ->paginate(999);

        if ($services) {
            foreach ($services as $service_index => $service) {
                $service->image = $service->image ? $service->image : '/storage/no-image.png';
                $service->image = ImageService::customImageSize($service->image, 410, 230, 100);
                $service->date = Carbon::parse($service->created_at)->format('d.m.Y');
                $services[$service_index] = $service;
            }
        }

//        dd($services);






        return view('frontend.service.index', compact(
            'services',
        ));
    }



}
