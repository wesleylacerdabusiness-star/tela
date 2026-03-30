<?php
// PARADISE CHECKOUT BUILDER - PROXY V30 (Direct Status Check)
$API_TOKEN         = 'nxp_live_73c5be7867dc212e8701a0d8f1183e26e599314dcdc790377753dc39ccc85cda';
$OFFER_HASH        = '';
$PRODUCT_HASH      = 'prod_526d203848bcf346';
$BASE_AMOUNT       = 1990;
$PRODUCT_TITLE     = 'Tela Privacy';
$IS_DROPSHIPPING   = false;
$THREE_STEP_CHECKOUT = false;
$TIMER_TEXT        = 'Esta oferta expira em: {{tempo}}';
$TIMER_BG_COLOR    = '#111827';
$TIMER_TEXT_COLOR  = '#ffffff';
$PIX_EXPIRATION_MINUTES = 5;
$IS_DROPSIPPING = false;

$FB_PIXEL_ID = '1352582576461739';
$FB_ACCESS_TOKEN = 'EAAIle1txe1ABQz9vpHyIRZBbzVX8Bu5D3jDp9WBdjIjS39yyREuCRuk9vsZCmA9o9Vb48lzwE2Xl2jJXDgInyAlP2RVSUgOcsuHiqVRjuTYezTgDEQa6GF1YMzEgVr74GGwAiZCG5tQWUHMrb4GjLFZA7ZBGAdO1lFAVomSceFVv3poSrUaZABbD3ZAyiF6SQZDZD';

function sendFacebookEvent($event_name, $event_data = [], $user_data = [], $custom_data = []) {
    global $FB_PIXEL_ID, $FB_ACCESS_TOKEN;

    $url = "https://graph.facebook.com/v18.0/{$FB_PIXEL_ID}/events";

    $hashed_user_data = [];
    if (!empty($user_data['email'])) {
        $hashed_user_data['em'] = [hash('sha256', strtolower(trim($user_data['email'])))];
    }
    if (!empty($user_data['phone'])) {
        $phone = preg_replace('/\D/', '', $user_data['phone']);
        if (strpos($phone, '55') !== 0) $phone = '55' . $phone;
        $hashed_user_data['ph'] = [hash('sha256', $phone)];
    }
    if (!empty($user_data['name'])) {
        $names = explode(' ', strtolower(trim($user_data['name'])), 2);
        $hashed_user_data['fn'] = [hash('sha256', $names[0])];
        if (isset($names[1])) {
            $hashed_user_data['ln'] = [hash('sha256', $names[1])];
        }
    }
    if (!empty($user_data['ip'])) {
        $hashed_user_data['client_ip_address'] = $user_data['ip'];
    }
    if (!empty($user_data['user_agent'])) {
        $hashed_user_data['client_user_agent'] = $user_data['user_agent'];
    }
    if (!empty($user_data['fbc'])) {
        $hashed_user_data['fbc'] = $user_data['fbc'];
    }
    if (!empty($user_data['fbp'])) {
        $hashed_user_data['fbp'] = $user_data['fbp'];
    }
    $hashed_user_data['country'] = [hash('sha256', 'br')];

    $event = [
        'event_name' => $event_name,
        'event_time' => time(),
        'action_source' => 'website',
        'event_source_url' => $event_data['event_source_url'] ?? ($_SERVER['HTTP_REFERER'] ?? ''),
        'user_data' => $hashed_user_data
    ];

    if (!empty($event_data['event_id'])) {
        $event['event_id'] = $event_data['event_id'];
    }

    if (!empty($custom_data)) {
        $event['custom_data'] = $custom_data;
    }

    $payload = [
        'data' => [json_encode($event)],
        'access_token' => $FB_ACCESS_TOKEN
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Style variables
$ELEMENT_BG_COLOR       = '#FFFFFF';
$ELEMENT_BORDER_RADIUS  = 12;
$CARD_RADIUS            = $ELEMENT_BORDER_RADIUS . 'px';
$BUTTON_RADIUS          = round($ELEMENT_BORDER_RADIUS * 0.8) . 'px';
$INPUT_RADIUS           = round($ELEMENT_BORDER_RADIUS * 0.66) . 'px';

// PIX Modal Texts & Styles
$PIX_MODAL_TITLE                     = 'Pagamento via PIX';
$PIX_MODAL_COPY_BUTTON_TEXT          = 'Copiar código PIX';
$PIX_MODAL_VALUE_TEXT                = '💰 Valor:';
$PIX_MODAL_EXPIRATION_TEXT           = '🕒 Válido até:';
$PIX_MODAL_SECURE_PAYMENT_TEXT       = 'Pagamento seguro via PIX';
$PIX_MODAL_BG_COLOR                  = '#FFFFFF';
$PIX_MODAL_TEXT_COLOR                = '#1f2937';
$PIX_MODAL_INFO_TEXT_COLOR           = '#0f172a';
$PIX_MODAL_SECURE_PAYMENT_TEXT_COLOR = '#00c27a';
$PIX_MODAL_BUTTON_COLOR              = '#00c27a';
$PIX_MODAL_BUTTON_TEXT_COLOR         = '#FFFFFF';
$PIX_MODAL_INPUT_BG_COLOR            = '#f9fafb';
$PIX_MODAL_INPUT_BORDER_COLOR        = '#d1d5db';
$PIX_MODAL_INPUT_TEXT_COLOR          = '#374151';
// Data
$ALL_ORDER_BUMPS      = json_decode(base64_decode('W10='), true);
$ALL_COUPONS          = json_decode(base64_decode('W10='), true);
$ALL_TESTIMONIALS     = json_decode(base64_decode('W10='), true);
$ALL_BANNERS          = json_decode(base64_decode('W10='), true);
$ALL_VIDEOS           = json_decode(base64_decode('W10='), true);
$ALL_TEXT_BLOCKS      = json_decode(base64_decode('W10='), true);
$COMPONENT_ORDER      = json_decode(base64_decode('WyJzaW5nbGV0b25faWRlbnRpdHkiLCJzaW5nbGV0b25fcGF5bWVudCJd'), true);
$SOCIAL_PROOF_SETTINGS = json_decode(base64_decode('eyJlbmFibGVkIjpmYWxzZSwibmFtZXMiOltdLCJwYXlvdXRNZXNzYWdlIjoie3tuYW1lfX0gYWNhYm91IGRlIHBhZ2FyIHt7dmFsdWV9fSIsInBheW91dE1pbiI6MTUwLCJwYXlvdXRNYXgiOjUwMCwiaW5pdGlhbERlbGF5Ijo1LCJkaXNwbGF5RHVyYXRpb24iOjQsImludGVydmFsTWluIjo4LCJpbnRlcnZhbE1heCI6MjB9'), true);
$SECURITY_SEAL_SETTINGS = json_decode(base64_decode('eyJlbmFibGVkIjpmYWxzZSwiYmFja2dyb3VuZENvbG9yIjoiI0ZGRkZGRiIsIml0ZW1zIjpbeyJpZCI6InNlYWwtMSIsImljb24iOiJleWUtc2xhc2giLCJ0aXRsZSI6IkRhZG9zIHByb3RlZ2lkb3MiLCJ0ZXh0IjoiT3Mgc2V1cyBkYWRvcyBzw6NvIGNvbmZpZGVuY2lhaXMgZSBzZWd1cm9zLiJ9LHsiaWQiOiJzZWFsLTIiLCJpY29uIjoibG9jayIsInRpdGxlIjoiUGFnYW1lbnRvIDEwMCUgU2VndXJvIiwidGV4dCI6IkFzIGluZm9ybWHDp8O1ZXMgZGVzdGEgY29tcHJhIHPDo28gY3JpcHRvZ3JhZmFkYXMuIn0seyJpZCI6InNlYWwtMyIsImljb24iOiJhY2FkZW1pYy1jYXAiLCJ0aXRsZSI6IkNvbnRlw7pkbyBBcHJvdmFkbyIsInRleHQiOiIxMDAlIHJldmlzYWRvIGUgYXByb3ZhZG8gcG9yIHByb2Zpc3Npb25haXMifSx7ImlkIjoic2VhbC00IiwiaWNvbiI6InNoaWVsZCIsInRpdGxlIjoiR2FyYW50aWEgZGUgNyBkaWFzIiwidGV4dCI6IlZvY8OqIGVzdGEgcHJvdGVnaWRvIHBvciB1bWEgZ2FyYW50aWEgZGUgc2F0aXNmYcOnw6NvIn1dfQ=='), true);
$STEP_ORDERS          = json_decode(base64_decode('eyJzdGVwMSI6WyJzaW5nbGV0b25faWRlbnRpdHkiXSwic3RlcDIiOlsic2luZ2xldG9uX2FkZHJlc3MiXSwic3RlcDMiOlsic2luZ2xldG9uX3N1bW1hcnkiLCJzaW5nbGV0b25fYnVtcHMiLCJzaW5nbGV0b25fcGF5bWVudCIsInNpbmdsZXRvbl9zZWN1cml0eV9zZWFsIl19'), true);

// Define as configurações do checkout para a função de renderização
$checkout_settings = [
    'buttonColor' => '#21bfeb',
    'headerColor' => '#21bfeb',
    'headerTextColor' => '#ffffff',
    'headerText' => 'Compra Segura e Rápida',
    'summaryText' => 'Você está adquirindo:',
    'productLogoURL' => 'https://multi.paradisepags.com/uploads/product_images/store_501_d0e68086732df6d577decc96ee74efd5.png',
    'title' => 'privacy kamilinha +18',
    'amountFormatted' => 'R$ ' . number_format(1990 / 100, 2, ',', '.'),
    'buttonText' => 'PAGAR AGORA',
    'fields' => [
        'name' => true,
        'email' => true,
        'phone' => false,
        'document' => false,
        'cep' => false
    ]
];
// Create maps for efficient lookup
$banners_map = array_column($ALL_BANNERS, null, 'id');
$videos_map = array_column($ALL_VIDEOS, null, 'id');
$testimonials_map = array_column($ALL_TESTIMONIALS, null, 'id');
$text_blocks_map = array_column($ALL_TEXT_BLOCKS, null, 'id');
$all_components_map = [
    'banners' => $banners_map,
    'videos' => $videos_map,
    'testimonials' => $testimonials_map,
    'text_blocks' => $text_blocks_map
];
// Agrupa todas as variáveis "globais" em um único array para passar para a função de renderização
$php_globals = [
    'ELEMENT_BG_COLOR' => $ELEMENT_BG_COLOR,
    'CARD_RADIUS' => $CARD_RADIUS,
    'INPUT_RADIUS' => $INPUT_RADIUS,
    'BUTTON_RADIUS' => $BUTTON_RADIUS,
    'ALL_ORDER_BUMPS' => $ALL_ORDER_BUMPS,
    'IS_DROPSIPPING' => $IS_DROPSIPPING,
    'THREE_STEP_CHECKOUT' => $THREE_STEP_CHECKOUT,
    'SECURITY_SEAL_SETTINGS' => $SECURITY_SEAL_SETTINGS
];
// --- AJAX ENDPOINTS ---

if (isset($_GET['action']) && $_GET['action'] === 'check_status') {
    header('Content-Type: application/json');
    $hash = $_GET['hash'] ?? '';

    if (empty($hash)) {
        http_response_code(400);
        echo json_encode(['error' => 'Hash is required']);
        exit;
    }

    $api_url = 'https://nexuspag.com/api/pix/' . urlencode($hash);
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'x-api-key: ' . $API_TOKEN
    ]);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($data && isset($data['status']) && $data['status'] === 'paid') {
        $transaction = $data;
        $event_id = 'purchase_' . $hash . '_' . time();

        $user_email = $_GET['email'] ?? '';
        $user_phone = $_GET['phone'] ?? '';
        $user_name = $_GET['name'] ?? '';
        $fbc = $_GET['fbc'] ?? '';
        $fbp = $_GET['fbp'] ?? '';
        $amount = floatval($_GET['amount'] ?? 0);

        // sendFacebookEvent('Purchase', [
        //     'event_id' => $event_id,
        //     'event_source_url' => $_SERVER['HTTP_REFERER'] ?? ''
        // ], [
        //     'email' => $user_email,
        //     'phone' => $user_phone,
        //     'name' => $user_name,
        //     'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
        //     'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        //     'fbc' => $fbc,
        //     'fbp' => $fbp
        // ], [
        //     'value' => $amount > 0 ? $amount / 100 : ($transaction['amount'] ?? 0) / 100,
        //     'currency' => 'BRL',
        //     'content_name' => $PRODUCT_TITLE,
        //     'content_ids' => [$PRODUCT_HASH],
        //     'content_type' => 'product'
        // ]);

        $data['fb_event_id'] = $event_id;
    }

    echo json_encode($data);
    exit;
}

// Endpoint for AJAX coupon validation
if (isset($_GET['action']) && $_GET['action'] === 'validate_coupon' && !$THREE_STEP_CHECKOUT) {
    header('Content-Type: application/json');
    $code = $_GET['code'] ?? '';
    $found_coupon = null;
    foreach ($ALL_COUPONS as $coupon) {
        if (strcasecmp($coupon['code'], $code) === 0) {
            $found_coupon = $coupon;
            break;
        }
    }
    if ($found_coupon) {
        echo json_encode(['success' => true, 'coupon' => $found_coupon]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Cupom inválido ou expirado.']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $api_url = 'https://nexuspag.com/api/pix/create';
    $data = json_decode(file_get_contents('php://input'), true);
    $customer_data = $data['customer'];
    $utms = $data['utms'] ?? [];

    // --- FAKE DATA GENERATION FOR DISABLED FIELDS V3.1 ---
    $cpfs = ['42879052882', '07435993492', '93509642791', '73269352468', '35583648805', '59535423720', '77949412453', '13478710634', '09669560950', '03270618638'];
    $firstNames = ['João', 'Marcos', 'Pedro', 'Lucas', 'Mateus', 'Gabriel', 'Daniel', 'Bruno', 'Maria', 'Ana', 'Juliana', 'Camila', 'Beatriz', 'Larissa', 'Sofia', 'Laura'];
    $lastNames = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves', 'Pereira', 'Lima', 'Gomes', 'Costa', 'Ribeiro', 'Martins', 'Carvalho'];
    $ddds = ['11', '21', '31', '41', '51', '61', '71', '81', '85', '92', '27', '48'];
    $emailProviders = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com.br', 'uol.com.br', 'terra.com.br'];
    $generatedName = null;

    if (empty($customer_data['name'])) {
        $randomFirstName = $firstNames[array_rand($firstNames)];
        $randomLastName = $lastNames[array_rand($lastNames)];
        $generatedName = $randomFirstName . ' ' . $randomLastName;
        $customer_data['name'] = $generatedName;
    }
    if (empty($customer_data['email'])) {
        $nameForEmail = $generatedName ?? ($customer_data['name'] ?? ($firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)]));
        $nameParts = explode(' ', (string)$nameForEmail, 2);
        
        $normalize = fn($str) => preg_replace('/[^w]/', '', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str) ?? ''));
        
        $emailUserParts = [];
        if (!empty($nameParts[0])) {
            $part1 = $normalize($nameParts[0]);
            if (strlen($part1) > 0) $emailUserParts[] = $part1;
        }
        if (isset($nameParts[1])) {
            $part2 = $normalize($nameParts[1]);
            if (strlen($part2) > 0) $emailUserParts[] = $part2;
        }

        if (empty($emailUserParts)) {
            $emailUserParts[] = 'cliente';
        }

        $emailUser = implode('.', $emailUserParts) . mt_rand(100, 999);
        $customer_data['email'] = $emailUser . '@' . $emailProviders[array_rand($emailProviders)];
    }
    // ALTERAÇÃO 1: Garante que o telefone sempre exista
    if (empty($customer_data['phone_number'])) {
        $customer_data['phone_number'] = $ddds[array_rand($ddds)] . '9' . mt_rand(10000000, 99999999);
    }
    if (empty($customer_data['document']) && !false) {
        $customer_data['document'] = $cpfs[array_rand($cpfs)];
    }
    // --- END FAKE DATA ---

    if (!$IS_DROPSHIPPING) {
        $customer_data['street_name'] = $customer_data['street_name'] ?? 'Rua do Produto Digital'; $customer_data['number'] = $customer_data['number'] ?? '0'; $customer_data['complement'] = $customer_data['complement'] ?? 'N/A'; $customer_data['neighborhood'] = $customer_data['neighborhood'] ?? 'Internet'; $customer_data['city'] = $customer_data['city'] ?? 'Brasil'; $customer_data['state'] = $customer_data['state'] ?? 'BR';
        if (empty($customer_data['zip_code'])) { $customer_data['zip_code'] = '00000000'; }
    }
// ... (código anterior)

    // --- DYNAMIC PRICE CALCULATION ---
    $total_amount = $customer_data['amount'];



    // Process Coupon (only if not 3-step checkout)
// ... (código seguinte)

    // Process Coupon (only if not 3-step checkout)
    if (!$THREE_STEP_CHECKOUT && isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
        $applied_coupon = null;
        foreach ($ALL_COUPONS as $c) {
            if (strcasecmp($c['code'], $_POST['coupon_code']) === 0) { $applied_coupon = $c; break; }
        }
        if ($applied_coupon) {
            if ($applied_coupon['type'] === 'fixed') {
                $total_amount -= $applied_coupon['value'];
            } elseif ($applied_coupon['type'] === 'percentage') {
                $discount_value = $total_amount * ($applied_coupon['value'] / 100);
                $total_amount -= $discount_value;
            }
        }
    }
    $total_amount = max(0, $total_amount);
    // --- END DYNAMIC PRICE ---
// ... (código anterior)

    $reference = 'CKO-' . uniqid();
    $clean_document = preg_replace('/\D/', '', $customer_data['document'] ?? '');
    $clean_phone = preg_replace('/\D/', '', $customer_data['phone_number'] ?? '');

    $payload = [
        "amount" => round($total_amount),
        "description" => $PRODUCT_TITLE,
        "reference" => $reference,
      "checkoutUrl" => $_POST['checkout_url'] ?? '', // <-- ADICIONE ESTA LINHA
        "productHash" => $PRODUCT_HASH, // <-- ADICIONADO AQUI
        "orderbump" => array_values(array_filter($_POST['orderbump'] ?? [])),
        "customer" => [
            'name' => $customer_data['name'] ?? 'N/A',
            'email' => $customer_data['email'] ?? 'na@na.com',
            'document' => $clean_document,
            'phone' => $clean_phone
        ]
    ];

    // Add tracking object if UTMs are present
    if (!empty($utms)) {
        $payload['tracking'] = [];
      $tracking_keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'src', 'sck', 'fbc', 'fbp'];
        foreach ($tracking_keys as $key) {
            if (!empty($utms[$key])) {
                $payload['tracking'][$key] = $utms[$key];
            }
        }
        // Ensure we don't send an empty tracking object
        if (empty($payload['tracking'])) {
            unset($payload['tracking']);
        }
    }

    // Adiciona o endereço ao payload se for dropshipping OU se um CEP opcional foi enviado
    if (($IS_DROPSHIPPING || !$IS_DROPSHIPPING) && !empty($customer_data['zip_code'])) {
        $payload['address'] = [
            // Para produtos digitais, preenchemos os outros campos com valores padrão se não existirem
            "street" => $customer_data['street_name'] ?? 'Rua do Produto Digital',
            "number" => $customer_data['number'] ?? '0',
            "neighborhood" => $customer_data['neighborhood'] ?? 'Internet',
            "city" => $customer_data['city'] ?? 'Brasil',
            "state" => $customer_data['state'] ?? 'BR',
            "zipcode" => preg_replace('/\D/', '', $customer_data['zip_code'] ?? ''),
            "complement" => $customer_data['complement'] ?? ''
        ];
    }

  
// ... (código seguinte)
    $paymentPayload = [
        "amount" => round($total_amount / 100),
        "description" => $PRODUCT_TITLE,
        "external_id" => $reference,
        "expiration" => 1800,
    ];

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'x-api-key: ' . $API_TOKEN
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentPayload));
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) { http_response_code(500); echo json_encode(['error' => 'cURL Error: ' . $curl_error]); exit; }
    
    $response_data = json_decode($response, true);
    if ($response_data && $http_code >= 200 && $http_code < 300) {
        // Updated for new API version: check for nested transaction data
        $transaction_data = $response_data['transaction'] ?? $response_data;

        $event_id = 'ic_' . ($transaction_data['id'] ?? $reference) . '_' . time();
        // sendFacebookEvent('InitiateCheckout', [
        //     'event_id' => $event_id,
        //     'event_source_url' => $_POST['checkout_url'] ?? ($_SERVER['HTTP_REFERER'] ?? '')
        // ], [
        //     'email' => $customer_data['email'] ?? '',
        //     'phone' => $customer_data['phone_number'] ?? '',
        //     'name' => $customer_data['name'] ?? '',
        //     'ip' => $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '',
        //     'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        //     'fbc' => $utms['fbc'] ?? '',
        //     'fbp' => $utms['fbp'] ?? ''
        // ], [
        //     'value' => round($total_amount) / 100,
        //     'currency' => 'BRL',
        //     'content_name' => $PRODUCT_TITLE,
        //     'content_ids' => [$PRODUCT_HASH],
        //     'content_type' => 'product'
        // ]);

        // Reshape response for frontend compatibility
        $frontend_response = [
            'hash' => $transaction_data['id'] ?? $reference,
            'pix' => [
                'qr_code' => $transaction_data['qr_code_base64'] ?? '',
                'pix_qr_code' => $transaction_data['pix_copia_cola'] ?? '',
                'expiration_date' => $transaction_data['expires_at'] ?? null
            ],
            'amount_paid' => round($total_amount),
            'fb_event_id' => $event_id,
        ];
        http_response_code($http_code);
        echo json_encode($frontend_response);
    } else {
        http_response_code($http_code);
        echo $response;
    }
    exit;
}
?>