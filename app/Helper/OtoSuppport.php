<?php

namespace App\Helper;

class OtoSuppport
{

    function __construct() {}

    function format_eac_string_to_array(string $string_data): array
    {
        $stringData = <<<DATA
            123 123123 123
        DATA;

        $convertArrary = explode("\n", $string_data);
        $formatArrayData = [];
        for ($i = 0; $i < count($convertArrary); $i++) {
            $format = explode("\t", str_replace('  ', " ", $convertArrary[$i]));
            if (count($format) < 3) {
                continue;
            }
            $formatArrayData[] = [
                "key" => str_replace(" ", "", $format[0]),
                "message" => [
                    "en" => str_replace(" / ", " ", $format[1]),
                    "vi" => str_replace(" / ", " ", $format[3]),
                ]
            ];
        }
        return $formatArrayData;
    }

    function format_otoEdu_string_to_array(string $string_data): array
    {
        $convertArrary = explode("\n", $string_data);
        $formatArrayData = [];
        for ($i = 0; $i < count($convertArrary); $i++) {
            $format = explode("\t", str_replace('  ', " ", $convertArrary[$i]));
            if (count($format) < 3) {
                continue;
            }
            $formatArrayData[] = [
                "key" => str_replace([" ", "MãLỗi"], "", $format[0]),
                "message" => [
                    "en" => str_replace(" / ", " ", $format[1]),
                    "vi" => str_replace(" / ", " ", $format[2]),
                ]
            ];
        }
        return $formatArrayData;
    }

    function format_vcedu_string_to_array(string $string_data) : array {
        $convertArrary = explode("\n", $string_data);

        $formatArrayData = [];
        for ($i = 0; $i < count($convertArrary); $i++) {
            $format = explode(":", str_replace('  ', " ", $convertArrary[$i]));
            if (count($format) < 2) {
                continue;
            }
            $formatArrayData[] = [
                "key" => str_replace([" ", "MãLỗi"], "", $format[0]),
                "message" => [
                    "en" => "",
                    "vi" => trim(str_replace(" / ", " ", $format[1])),
                ]
            ];
        }
        return $formatArrayData;
    }

    function format_hocngheoto_string_to_array(string $string_data) : array {
        $convertArrary = explode("\n", $string_data);

        $formatArrayData = [];
        for ($i = 0; $i < count($convertArrary); $i++) {
            $format = explode(" ", str_replace('  ', " ", $convertArrary[$i]), 2);
            if (count($format) < 2) {
                continue;
            }
            $messageValue = explode('#', $format[1]);

            $formatArrayData[] = [
                "key" => str_replace([" ", "MãLỗi"], "", $format[0]),
                "message" => [
                    "en" => trim(str_replace(" / ", " ", $messageValue[0])),
                    "vi" => trim(str_replace(" / ", " ", $messageValue[1])),
                ]
            ];
        }
        return $formatArrayData;
    }

    // thanhxuan
    function format_thanhxuan_string_to_array(string $string_data) : array {
        $convertArrary = explode("\n", $string_data);
        $formatArrayData = [];
        for ($i = 0; $i < count($convertArrary); $i++) {
            $format = explode(":", str_replace('  ', " ", $convertArrary[$i]), 2);
            if (count($format) < 2) {
                continue;
            }
            $formatArrayData[] = [
                "key" => str_replace([" "], "", $format[0]),
                "message" => [
                    "en" => "",
                    "vi" => trim(str_replace([" / ", " :"], " ", $format[1])),
                ]
            ];
        }
        return $formatArrayData;
    }
}
