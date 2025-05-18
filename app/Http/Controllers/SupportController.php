<?php

namespace App\Http\Controllers;

use App\Helper\OtoSuppport;
use App\Helper\Until;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    use Until;

    protected $otoSuppport;

    function __construct(
        OtoSuppport $otoSuppport
    ) {
        $this->otoSuppport = $otoSuppport;
    }

    function importData()
    {
        $allData = [];

        $sources = [
            ["data/oto-error-code-eac-1.txt", 'eac'],
            ["data/oto-error-code-eac-2.txt", 'eac'],
            ["data/oto-error-code-eac-4.txt", 'eac4'],
            ["data/oto-error-code-oto-edu-1.txt", 'otoEdu'],
            ["data/oto-error-code-vcedu-1.txt", 'vcedu'],
            ["data/oto-error-code-hocngheoto-1.txt", 'hocngheoto'],
            ["data/oto-error-code-thanhxuan-1.txt", 'thanhxuan'],
            // ["data/oto-lib-eac.txt", 'eacLib'],
        ];
        foreach ($sources as $value) {
            $stringData = Storage::disk('protected')->get($value[0]);
            switch ($value[1]) {
                case 'eac':
                    $allData = array_merge($allData, $this->otoSuppport->format_eac_string_to_array($stringData));
                    break;
                case 'eac4':
                    $allData = array_merge($allData, $this->otoSuppport->format_eac_4_string_to_array($stringData));
                    break;
                case 'eacLib':
                    $allData = array_merge($allData, $this->otoSuppport->format_lib_string_to_array($stringData));
                    break;
                case 'otoEdu':
                    $allData = array_merge($allData, $this->otoSuppport->format_otoEdu_string_to_array($stringData));
                    break;
                case 'vcedu':
                    $allData = array_merge($allData, $this->otoSuppport->format_vcedu_string_to_array($stringData));
                    break;
                case 'hocngheoto':
                    $allData = array_merge($allData, $this->otoSuppport->format_hocngheoto_string_to_array($stringData));
                    break;
                case 'thanhxuan':
                    $allData = array_merge($allData, $this->otoSuppport->format_thanhxuan_string_to_array($stringData));
                    break;
                default:
                    $data = json_decode($stringData, true);
                    foreach ($data as &$value) {
                        $value['viKey'] = $this->vn_to_str($value['vi'], true);
                    }
                    return ($data);
            }
        }

        // dd(count($allData));
        return response()->json($allData);
    }
}
