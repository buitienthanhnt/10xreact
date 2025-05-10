<?php
$createSynthesis = function($token, $app_id, $callback_url)
{
    $curl = curl_init();
    $postField = [
        'app_id' => $app_id,
        'callback_url' => $callback_url,
        'voice_code' => 'hn_female_nganha_child_22k-vc',
        'speed_rate' => '1.0',
        'input_text' => '
        Bài thơ: An Nhân huyện vấn túc, Tạm dịch: Tìm chỗ nghỉ tại huyện An Nhân.

Phiên âm:
Mạc yến phiên lôi thiên tác vân,
Nhất thanh quy điểu vạn lâm hôn.
Hoang thành tịch mịch vô kham tửu,
Đăng hạ chi di vũ đả môn.

Dịch thơ:
Én tránh sấm trời mây vần vũ,
Rừng tối tăm một tiếng chim về.
Không có rượu thành hoang vắng vẻ,
Cửa dội mưa cằm chống đèn khuya.'
    ];

    $postField = json_encode($postField);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://vbee.vn/api/v1/tts',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 120000,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postField,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
};

echo(get_class($createSynthesis));
