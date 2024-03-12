<?php

namespace App\Http\Controllers\API\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\HolidayPlanResource;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GeneratePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $plans = HolidayPlan::all();

        $html = $this->buildPdfHtml(HolidayPlanResource::collection($plans));

        $pdf = PDF::loadHTML($html);

        $fileName = 'holiday-plans-' . time() . '.pdf';

        Storage::put('public/pdf/' . $fileName, $pdf->output());

        $url = Storage::url('pdf/' . $fileName);

        return response()->json([
            'message' => 'PDF generated successfully.',
            'url' => $url,
        ]);
    }

    /**
     * Build HTML for PDF.
     *
     * @param $plans Collection of holidays plans
     * @return string HTML
     */
    private function buildPdfHtml($plans)
    {
        $html = '<h1>Holidays Plans</h1>';

        foreach ($plans as $plan) {
            $description_html = Str::markdown($plan->description);

            $html .= "<div>";
            $html .= "<h2>$plan->title</h2>";
            $html .= "<p><strong>Localization:</strong> $plan->location</p>";
            $html .= "<p><strong>Descrição:</strong> $description_html</p>";
            $html .= "<p><strong>Participans:</strong> $plan->participants</p>";
            $html .= "<p><strong>Date:</strong> $plan->date</p>";
            $html .= "</div><hr>";
        }

        return $html;
    }
}
