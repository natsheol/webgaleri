<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentSummaryController extends Controller
{
    public function download(Request $request, House $house)
    {
        $status = $request->query('status', 'active');
        $startYear = (int) $request->query('start_year', date('Y'));
        $endYear = (int) $request->query('end_year', date('Y'));
        $singleYear = $request->boolean('single_year');

        if ($singleYear) {
            $endYear = $startYear;
        }

        $query = $house->studentsRelation();
        $currentYear = date('Y');
        $sevenYearsAgo = $currentYear - 6;

        if ($status === 'active') {
            $query->whereBetween('year', [$sevenYearsAgo, $currentYear]);
            $titleStatus = 'Active Students';
        } else {
            $query->where('year', '<', $sevenYearsAgo);
            $titleStatus = 'Alumni';
        }

        $query->whereBetween('year', [$startYear, $endYear]);

        $students = $query->get();

        $title = $startYear === $endYear
            ? "{$titleStatus} Summary ({$startYear})"
            : "{$titleStatus} Summary ({$startYear} - {$endYear})";

        $pdf = Pdf::loadView('admin.houses.summary.pdf', [
            'house' => $house,
            'students' => $students,
            'title' => $title,
            'status' => ucfirst($status),
            'startYear' => $startYear,
            'endYear' => $endYear,
            'singleYear' => $singleYear,
        ])->setPaper('a4', 'portrait');

        $fileName = "{$house->name}_{$status}_summary_{$startYear}";
        if (!$singleYear) {
            $fileName .= "-{$endYear}";
        }
        $fileName .= ".pdf";

        return $pdf->download($fileName);
    }
}
