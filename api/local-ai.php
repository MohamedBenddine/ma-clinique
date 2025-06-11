<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Enable error logging
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $message = $input['message'] ?? '';
    
    if (empty($message)) {
        echo json_encode(['error' => 'No message provided']);
        exit;
    }
    
    // Detect language of the user's message
    $isArabic = detectArabic($message);
    
    // Create language-appropriate system prompt
    if ($isArabic) {
        $systemPrompt = "أنت مساعد طبي ذكي. يجب أن ترد باللغة العربية دائماً. مهمتك:
1. تقديم معلومات صحية مفيدة وموثوقة باللغة العربية
2. النصح دائماً بمراجعة الأطباء المختصين للحصول على تشخيص دقيق
3. تقديم إجابات مختصرة وواضحة وودودة باللغة العربية
4. في حالة الأعراض الخطيرة، التوجيه الفوري لطلب المساعدة الطبية العاجلة
5. تقديم معلومات عن العيادة والمواعيد عند الطلب

اجعل إجاباتك عملية ومساعدة باللغة العربية فقط. لا تستخدم الإنجليزية في إجابتك.";
    } else {
        $systemPrompt = "You are an intelligent medical assistant. You must respond in English only. Your tasks:
1. Provide helpful and reliable health information in English
2. Always recommend consulting with specialized doctors for accurate diagnosis
3. Provide brief, clear, and friendly answers in English
4. For serious symptoms, immediately direct to seek urgent medical help
5. Provide clinic and appointment information when requested

Make your answers practical and helpful in English only. Do not use Arabic in your response.";
    }
    
    // Extract just the user's question (remove conversation context for language detection)
    $userMessage = extractUserMessage($message);
    
    // Format for Llama 3.2 chat template
    $formattedPrompt = "<|start_header_id|>system<|end_header_id|>\n\n" . $systemPrompt . "<|eot_id|>";
    $formattedPrompt .= "<|start_header_id|>user<|end_header_id|>\n\n" . $userMessage . "<|eot_id|>";
    $formattedPrompt .= "<|start_header_id|>assistant<|end_header_id|>\n\n";
    
    // Prepare data for Ollama with correct model name
    $postData = json_encode([
        'model' => 'llama3.2:3b',
        'prompt' => $formattedPrompt,
        'stream' => false,
        'options' => [
            'temperature' => 0.7,
            'top_p' => 0.9,
            'num_predict' => 300,
            'stop' => [
                "<|start_header_id|>",
                "<|end_header_id|>", 
                "<|eot_id|>"
            ]
        ]
    ]);
    
    // Call local Ollama API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:11434/api/generate');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($postData)
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    // Log the response for debugging
    error_log("User message language: " . ($isArabic ? 'Arabic' : 'English'));
    error_log("Ollama Response Code: $httpCode");
    
    if ($curlError) {
        error_log("Curl Error: $curlError");
        $fallbackResponse = getFallbackResponse($userMessage, $isArabic);
        echo json_encode(['response' => $fallbackResponse]);
        exit;
    }
    
    if ($httpCode === 200 && $response) {
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON Decode Error: " . json_last_error_msg());
            $fallbackResponse = getFallbackResponse($userMessage, $isArabic);
            echo json_encode(['response' => $fallbackResponse]);
            exit;
        }
        
        $aiResponse = $data['response'] ?? '';
        
        if (empty($aiResponse)) {
            error_log("Empty AI response");
            $fallbackResponse = getFallbackResponse($userMessage, $isArabic);
            echo json_encode(['response' => $fallbackResponse]);
            exit;
        }
        
        // Clean up the response for Llama 3.2
        $aiResponse = cleanLlamaResponse($aiResponse, $isArabic);
        
        // Ensure the response is helpful
        if (strlen(trim($aiResponse)) < 20) {
            $aiResponse = $isArabic ? 
                "أعتذر، لم أتمكن من تقديم إجابة مفيدة. يرجى إعادة صياغة سؤالك أو الاتصال بعيادتنا للحصول على مساعدة مباشرة." :
                "Sorry, I couldn't provide a helpful answer. Please rephrase your question or contact our clinic for direct assistance.";
        }
        
        echo json_encode(['response' => $aiResponse]);
    } else {
        error_log("Ollama API Error - HTTP Code: $httpCode");
        
        // Provide fallback responses based on the request
        $fallbackResponse = getFallbackResponse($userMessage, $isArabic);
        echo json_encode(['response' => $fallbackResponse]);
    }
} else {
    echo json_encode(['error' => 'Method not allowed']);
}

function detectArabic($text) {
    // Check if text contains Arabic characters
    return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
}

function extractUserMessage($fullMessage) {
    // Extract the last user message from the conversation context
    $parts = explode('المريض:', $fullMessage);
    if (count($parts) > 1) {
        $lastPart = end($parts);
        $userMsg = explode("\nالمساعد:", $lastPart)[0];
        return trim($userMsg);
    }
    
    // If no Arabic context found, return the full message
    return $fullMessage;
}

function cleanLlamaResponse($response, $isArabic) {
    // Remove any remaining chat template tokens
    $response = preg_replace('/<\|.*?\|>/', '', $response);
    
    // Remove any assistant prefixes
    $response = preg_replace('/^(Assistant:|المساعد:)\s*/i', '', $response);
    
    // Clean up whitespace
    $response = trim($response);
    
    // Add medical disclaimer based on language
    if (!strpos($response, 'استشارة طبية') && !strpos($response, 'medical advice')) {
        if (strpos($response, 'أعراض') !== false || strpos($response, 'مرض') !== false || 
            strpos($response, 'symptoms') !== false || strpos($response, 'disease') !== false) {
            
            if ($isArabic) {
                $response .= '\n\n*ملاحظة مهمة: هذه معلومات عامة فقط. يرجى استشارة طبيب مختص للحصول على تشخيص وعلاج مناسب.*';
            } else {
                $response .= '\n\n*Important note: This is general information only. Please consult a healthcare professional for proper diagnosis and treatment.*';
            }
        }
    }
    
    return $response;
}

function getFallbackResponse($message, $isArabic) {
    $msg = strtolower($message);
    
    if (strpos($msg, 'موعد') !== false || strpos($msg, 'appointment') !== false || strpos($msg, 'book') !== false) {
        return $isArabic ? 
            "يمكنك حجز موعد بطرق متعددة:\n• من خلال موقعنا الإلكتروني - انقر على زر 'احجز موعد'\n• اتصل بنا على: (555) 123-4567\n• زيارة العيادة خلال ساعات العمل\n\nما نوع التخصص الذي تحتاجه؟" :
            "You can book an appointment in several ways:\n• Through our website - click 'Book Appointment'\n• Call us at: (555) 123-4567\n• Visit our clinic during working hours\n\nWhat type of specialist do you need?";
    }
    
    if (strpos($msg, 'ساعات') !== false || strpos($msg, 'وقت') !== false || strpos($msg, 'hours') !== false || strpos($msg, 'time') !== false) {
        return $isArabic ?
            "⏰ ساعات عمل العيادة:\n• الإثنين - الجمعة: 9:00 ص - 5:00 م\n• السبت: 9:00 ص - 2:00 م\n• الأحد: مغلق\n• خدمة الطوارئ: 24/7" :
            "⏰ Clinic Hours:\n• Monday - Friday: 9:00 AM - 5:00 PM\n• Saturday: 9:00 AM - 2:00 PM\n• Sunday: Closed\n• Emergency Service: 24/7";
    }
    
    if (strpos($msg, 'طوارئ') !== false || strpos($msg, 'عاجل') !== false || strpos($msg, 'emergency') !== false || strpos($msg, 'urgent') !== false) {
        return $isArabic ?
            "🚨 في حالات الطوارئ الطبية:\n• اتصل بالإسعاف فوراً: 911\n• اذهب لأقرب قسم طوارئ\n• للحالات غير العاجلة: احجز موعد عادي\n\nسلامتك أهم من أي شيء آخر!" :
            "🚨 For Medical Emergencies:\n• Call ambulance immediately: 911\n• Go to nearest emergency room\n• For non-urgent cases: book regular appointment\n\nYour safety is most important!";
    }
    
    if (strpos($msg, 'خدمات') !== false || strpos($msg, 'تخصص') !== false || strpos($msg, 'services') !== false || strpos($msg, 'treatment') !== false) {
        return $isArabic ?
            "🏥 خدماتنا الطبية:\n• الطب العام والاستشارات\n• التخصصات الطبية المختلفة\n• الفحوصات والتحاليل\n• الرعاية الوقائية\n• خدمات الطوارئ\n\nأي تخصص يهمك؟" :
            "🏥 Our Medical Services:\n• General Medicine & Consultations\n• Various Medical Specialties\n• Laboratory Tests & Examinations\n• Preventive Care\n• Emergency Services\n\nWhich specialty interests you?";
    }
    
    if (strpos($msg, 'hello') !== false || strpos($msg, 'hi') !== false || strpos($msg, 'مرحبا') !== false || strpos($msg, 'السلام') !== false) {
        return $isArabic ?
            "مرحباً بك! 👋 أنا المساعد الطبي الذكي لعيادتنا. يمكنني مساعدتك في:\n• حجز المواعيد\n• معلومات عن خدماتنا\n• الإجابة على استفساراتك الطبية العامة\n• توجيهك للتخصص المناسب\n\nكيف يمكنني مساعدتك اليوم؟" :
            "Hello! 👋 I'm the AI medical assistant for our clinic. I can help you with:\n• Booking appointments\n• Information about our services\n• General medical inquiries\n• Directing you to the right specialist\n\nHow can I help you today?";
    }
    
    return $isArabic ?
        "شكراً لتواصلك معنا! 🙏 للحصول على أفضل مساعدة طبية، أنصحك بـ:\n• حجز موعد مع أطبائنا المختصين\n• الاتصال بعيادتنا للاستفسارات المعقدة\n• زيارة موقعنا لمزيد من المعلومات\n\nصحتك تهمنا!" :
        "Thank you for contacting us! 🙏 For the best medical assistance, I recommend:\n• Booking an appointment with our specialists\n• Calling our clinic for complex inquiries\n• Visiting our website for more information\n\nYour health matters to us!";
}
?>