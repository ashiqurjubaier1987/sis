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
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SubjectExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected Collection $subjects;

    public function __construct(Collection $subjects)
    {
        $this->subjects = $subjects;
    }

    public function collection(): Collection
    {
        return $this->subjects;
    }

    public function headings(): array
    {
        return [
            '#',
            'Subject Name',
            'Code',
            'Description',
            'Status',
            'Created At',
        ];
    }

    public function map($subject): array
    {
        static $index = 0;
        $index++;

        return [
            $index,
            $subject->name,
            $subject->code,
            $subject->description ?? '—',
            $subject->is_active ? 'Active' : 'Inactive',
            $subject->created_at->format('d M Y'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            // Bold header row
            1 => ['font' => ['bold' => true]],
        ];
    }
}