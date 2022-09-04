<?php

use Illuminate\Http\JsonResponse;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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

if (!function_exists('get_csv_data')) {
    /**
     * Get csv file data
     * 
     * @param $file
     * @param bool $returnHeader
     * @return mixed
     */
    function get_csv_data($file, $returnHeader = false)
    {
        $reader = new Csv();

        $sheetData = $reader->setDelimiter(',')
                ->setInputEncoding('Shift-JIS')
                ->load($file)
                ->getActiveSheet()
                ->toArray(null, true, true, true);

        if (!$returnHeader) {
            array_shift($sheetData);
        }

        return $sheetData;
    }
}

if (!function_exists('get_tsv_data')) {
    /**
     * Get tsv file data
     * @param $file
     * @return mixed
     */
    function get_tsv_data($file)
    {
        $currentLocale = setlocale(LC_ALL, '0'); // Backup current locale.

        setlocale(LC_ALL, 'ja_JP.UTF-8');

        // Read the file content in SJIS-Win.
        $content = file_get_contents($file);

        // Convert file content to SJIS-Win.
        $content = mb_convert_encoding($content, 'UTF-8', 'SJIS-win');

        // Save the file as UTF-8 in a temp location.
        $fp = tmpfile();
        fwrite($fp, $content);
        rewind($fp);

        setlocale(LC_ALL, $currentLocale); // Restore the backed-up locale.
        $array = [];

        while (($data = fgetcsv($fp, 1000, ',')) !== false) {
            $array[] = $data;
        }

        return $array;
    }
}

if (!function_exists('get_xlsx_data')) {
    /**
     * Get xlsx file data
     * 
     * @param $file
     * @param bool $returnHeader
     * @return mixed
     */
    function get_xlsx_data($file, $returnHeader = false)
    {
        $reader = new Xlsx();

        $sheetData = $reader->load($file)
                ->getActiveSheet()
                ->toArray(null, true, true, true);

        if (!$returnHeader) {
            array_shift($sheetData);
        }

        return $sheetData;
    }
}

if (!function_exists('get_xls_data')) {
    /**
     * Get xls file data
     * 
     * @param $file
     * @param bool $returnHeader
     * @return mixed
     */
    function get_xls_data($file, $returnHeader = false)
    {
        $reader = new Xls();

        $sheetData = $reader->load($file)
                ->getActiveSheet()
                ->toArray(null, true, true, true);

        if (!$returnHeader) {
            array_shift($sheetData);
        }

        return $sheetData;
    }
}

if (!function_exists('get_data_import')) {
    /**
     * Get data import
     * 
     * @param $file
     * @return mixed
     */
    function get_data_import($file, $returnHeader = false)
    {
        $extension = $file->getClientOriginalExtension();

        switch ($extension) {
            case 'csv':
                $sheetData = get_csv_data($file, $returnHeader);
                break;
            case 'tsv':
                $sheetData = get_tsv_data($file, $returnHeader);
                break;
            case 'xlsx':
                $sheetData = get_xlsx_data($file, $returnHeader);
                break;
            default:
                $sheetData = get_xls_data($file, $returnHeader);
                break;
        }

        return $sheetData;
    }
}

if (!function_exists('strToSlug')) {
    function strToSlug($title, $separator = '_')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator === '-' ? '_' : '-';

        $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', strtolower($title));

        // Replace all separator characters and whitespace by a single separator
        $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

        return trim($title, $separator);
    }
}

if (!function_exists('valOfCell')) {
    function valOfCell($cell)
    {
        $value = trim($cell);

        return $value ?? null;
    }
}
