<?php
/*
 * Created on Fri Feb 27 2026
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2026 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */


namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubjectExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected array $rows;

    public function __construct(Collection $subjects)
    {
        $this->rows = $subjects->values()->map(function ($subject, $index) {
            $teachers = $subject->teachers->pluck('name')->join(', ') ?: '—';
            return [
                $index + 1,
                $subject->name,
                $subject->code ?? '—',
                $teachers,
                $subject->description ?? '—',
                $subject->is_active ? 'Active' : 'Inactive',
                $subject->created_at ? $subject->created_at->format('d M Y') : '—',
            ];
        })->toArray();
    }

    public function array(): array
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            '#',
            'Subject Name',
            'Code',
            'Teacher(s)',
            'Description',
            'Status',
            'Created At',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
