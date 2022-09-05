<?php

use Illuminate\Http\JsonResponse;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (!function_exists('defineResponse')) {
    /**
     * Define response message
     *
     * @param $message
     * @param $status
     * @param $data
     * @param $other
     * @return JsonResponse
     */
    function defineResponse($message, $status = 200, $data = [], $other = []): JsonResponse
    {
        $responses = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $responses['data'] = $data;
        }

        return response()->json(
            array_merge($responses, $other),
            $status
        );
    }
}

if (!function_exists('getDataImport')) {
    /**
     * Get data import
     *
     * @param $file
     * @param bool $header
     * @return mixed
     */
    function getDataImport($file, $header = false)
    {
        $extension = $file->getClientOriginalExtension();

        switch ($extension) {
            case config('constants.mimes.csv'): // csv
                $reader = new Csv();
                $sheetData = $reader->setDelimiter(',');
                break;
            case config('constants.mimes.tsv'): // tsv
                $reader = IOFactory::createReader('Csv');
                $sheetData = $reader->setDelimiter("\t");
                break;
            case config('constants.mimes.xlsx'): // xlsx
                $reader = new Xlsx();
                break;
            case config('constants.mimes.xls'): // xls
                $reader = new Xls();
                break;
        }

        $sheetData = $reader->load($file)
            ->getActiveSheet()
            ->toArray(null, true, true, true);

        if (!$header) {
            array_shift($sheetData);
        }

        return $sheetData;
    }
}

if (!function_exists('slug')) {
    /**
     * Create slug
     *
     * @param string $title
     * @param string $separator
     * @return string
     */
    function slug($title, $separator = '_')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('![' . preg_quote($flip) . ']+!u', $separator, $title);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^' . preg_quote($separator) . '\pL\pN\s]+!u', '', strtolower($title));

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('![' . preg_quote($separator) . '\s]+!u', $separator, $title);

        return trim($title, $separator);
    }
}

if (!function_exists('getValueOfCell')) {
    /**
     * Get value of cell except space
     *
     * @param string $cell
     * @return string
     */
    function getValueOfCell($cell)
    {
        $value = trim($cell);

        return $value ?? null;
    }
}
