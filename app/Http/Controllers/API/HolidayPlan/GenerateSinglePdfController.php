<?php

namespace App\Http\Controllers\API\HolidayPlan;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\HolidayPlanResource;
use App\Models\HolidayPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateSinglePdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, HolidayPlan $holidayPlan)
    {
        $html = $this->buildPdfHtml(new HolidayPlanResource($holidayPlan));

        $pdf = PDF::loadHTML($html);

        $fileName = 'holiday-plan-' . time() . '.pdf';

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
     * @param $plan An instance of holiday plan
     * @return string HTML
     */
    private function buildPdfHtml($plan)
    {
        $html = '<h1>Holiday Plan</h1>';

        $description_html = Str::markdown($plan->description);

        $html .= "<div>";
        $html .= "<h2>$plan->title</h2>";
        $html .= "<p><strong>Localization:</strong> $plan->location</p>";
        $html .= "<p><strong>Descrição:</strong> $description_html</p>";
        $html .= "<p><strong>Participans:</strong> $plan->participants</p>";
        $html .= "<p><strong>Date:</strong> $plan->date</p>";
        $html .= "</div><hr>";

        return $html;
    }
}
