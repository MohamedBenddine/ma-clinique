<?php
class Translation {
    private static $translations = [
        // Navigation
        'about' => ['en' => 'About', 'ar' => 'من نحن'],
        'check_appointment' => ['en' => 'Check Appointment', 'ar' => 'تحقق من الموعد'],
        'appointment' => ['en' => 'Appointment', 'ar' => 'حجز موعد'],
        'contact' => ['en' => 'Contact', 'ar' => 'اتصل بنا'],
        'doctor_login' => ['en' => 'Doctor Portal', 'ar' => 'بوابة الطبيب'],
        
        // Slideshow/Hero Section
        'health_care_available' => ['en' => 'HEALTH CARE AVAILABLE', 'ar' => 'الرعاية الصحية متاحة'],
        'book_now' => ['en' => 'BOOK NOW', 'ar' => 'احجز الآن'],
        'learn_more' => ['en' => 'LEARN MORE', 'ar' => 'اعرف المزيد'],
        'medical_services_terms' => ['en' => '*Professional medical services available, contact us for appointment details.', 'ar' => '*خدمات طبية مهنية متاحة، اتصل بنا لتفاصيل المواعيد.'],
        'medical_facility' => ['en' => 'Medical Facility', 'ar' => 'المرفق الطبي'],
        'beautiful_images' => ['en' => 'Beautiful Images', 'ar' => 'صور جميلة'],
        
        // About Section - Updated with your content
        'about_title' => ['en' => 'About us', 'ar' => 'من نحن'],
        'mission_statement' => ['en' => 'Our mission declares our purpose of existence as a healthcare technology solution and our objectives.', 'ar' => 'تعلن مهمتنا عن هدف وجودنا كحل تقني للرعاية الصحية وأهدافنا.'],
        'mission_description' => ['en' => 'To provide every user — whether patient or doctor — much more than expected in terms of usability, accessibility, data security, and personalized service, by understanding local healthcare needs and continuously innovating to ultimately deliver an unmatched experience in medical appointment scheduling through ob-doc-web.', 'ar' => 'تقديم أكثر مما هو متوقع لكل مستخدم - سواء كان مريضاً أو طبيباً - من حيث سهولة الاستخدام وإمكانية الوصول وأمان البيانات والخدمة الشخصية، من خلال فهم احتياجات الرعاية الصحية المحلية والابتكار المستمر لتقديم تجربة لا مثيل لها في جدولة المواعيد الطبية.'],
        'clinic_license' => ['en' => '3 Licence', 'ar' => '3 ليسانس'],
        'clinic_name' => ['en' => 'Ouarnoughi-Benddine', 'ar' => 'ورنوغي - بن الدين'],
        'medical_center' => ['en' => 'Medical Center', 'ar' => 'مركز طبي'],
        
        // Immediate Section
        'need_immediate_attention' => ['en' => 'Need Immediate Medical Attention?', 'ar' => 'تحتاج إلى رعاية طبية فورية؟'],
        'book_appointment_subtitle' => ['en' => 'Book your appointment now or call our emergency hotline', 'ar' => 'احجز موعدك الآن أو اتصل بخط الطوارئ'],
        'book_appointment' => ['en' => 'Book Appointment', 'ar' => 'حجز موعد'],
        'call_now' => ['en' => 'Call Now', 'ar' => 'اتصل الآن'],
        
        // Gallery Section
        'our_medical_gallery' => ['en' => 'Our Medical Gallery', 'ar' => 'معرض الصور الطبي'],
        'gallery_subtitle' => ['en' => 'Take a look at our state-of-the-art facilities and professional team', 'ar' => 'ألق نظرة على مرافقنا المتطورة وفريقنا المهني'],
        'professional_medical_team' => ['en' => 'Professional Medical Team', 'ar' => 'فريق طبي محترف'],
        'professional_team_desc' => ['en' => 'Our experienced doctors providing exceptional healthcare services', 'ar' => 'أطباؤنا ذوو الخبرة يقدمون خدمات رعاية صحية استثنائية'],
        'modern_medical_facilities' => ['en' => 'Modern Medical Facilities', 'ar' => 'مرافق طبية حديثة'],
        'modern_facilities_desc' => ['en' => 'State-of-the-art equipment and comfortable patient areas', 'ar' => 'معدات متطورة ومناطق مريحة للمرضى'],
        'comprehensive_patient_care' => ['en' => 'Comprehensive Patient Care', 'ar' => 'رعاية شاملة للمرضى'],
        'patient_care_desc' => ['en' => 'Dedicated to providing personalized healthcare solutions', 'ar' => 'مكرسون لتقديم حلول رعاية صحية مخصصة'],
        'advanced_medical_technology' => ['en' => 'Advanced Medical Technology', 'ar' => 'تكنولوجيا طبية متقدمة'],
        'advanced_technology_desc' => ['en' => 'Latest diagnostic and treatment equipment for accurate results', 'ar' => 'أحدث معدات التشخيص والعلاج للحصول على نتائج دقيقة'],
        
        // Contact Us Section
        'contact_us' => ['en' => 'Contact Us', 'ar' => 'اتصل بنا'],
        'contact_subtitle' => ['en' => 'Get in touch with us for any inquiries or appointments', 'ar' => 'تواصل معنا لأي استفسارات أو مواعيد'],
        'get_in_touch' => ['en' => 'Get In Touch', 'ar' => 'تواصل معنا'],
        'address' => ['en' => 'Address', 'ar' => 'العنوان'],
        'phone' => ['en' => 'Phone', 'ar' => 'الهاتف'],
        'email' => ['en' => 'Email', 'ar' => 'البريد الإلكتروني'],
        'working_hours' => ['en' => 'Working Hours', 'ar' => 'ساعات العمل'],
        'working_hours_text' => ['en' => 'Mon - Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 4:00 PM<br>Sun: Emergency Only', 'ar' => 'الإثنين - الجمعة: 8:00 ص - 6:00 م<br>السبت: 9:00 ص - 4:00 م<br>الأحد: طوارئ فقط'],
        'send_message' => ['en' => 'Send us a Message', 'ar' => 'أرسل لنا رسالة'],
        'full_name' => ['en' => 'Full Name', 'ar' => 'الاسم الكامل'],
        'email_address' => ['en' => 'Email Address', 'ar' => 'عنوان البريد الإلكتروني'],
        'phone_number' => ['en' => 'Phone Number', 'ar' => 'رقم الهاتف'],
        'subject' => ['en' => 'Subject', 'ar' => 'الموضوع'],
        'select_subject' => ['en' => 'Select a subject', 'ar' => 'اختر موضوعاً'],
        'general_inquiry' => ['en' => 'General Inquiry', 'ar' => 'استفسار عام'],
        'emergency' => ['en' => 'Emergency', 'ar' => 'طارئ'],
        'other' => ['en' => 'Other', 'ar' => 'أخرى'],
        'message' => ['en' => 'Message', 'ar' => 'الرسالة'],
        'message_placeholder' => ['en' => 'Tell us how we can help you...', 'ar' => 'أخبرنا كيف يمكننا مساعدتك...'],
        'send_message_btn' => ['en' => 'Send Message', 'ar' => 'إرسال الرسالة'],
        'message_sent' => ['en' => 'Message Sent Successfully!', 'ar' => 'تم إرسال الرسالة بنجاح!'],
        'message_sent_desc' => ['en' => 'Thank you for contacting us. We\'ll get back to you within 24 hours.', 'ar' => 'شكراً لتواصلك معنا. سنعاود الاتصال بك خلال 24 ساعة.'],
        
        // About/Stats Section
        'professional_care' => ['en' => 'Professional Medical Care', 'ar' => 'رعاية طبية مهنية'],
        'emergency_services' => ['en' => '24/7 Emergency Services', 'ar' => 'خدمات طوارئ على مدار الساعة'],
        'modern_equipment' => ['en' => 'Modern Medical Equipment', 'ar' => 'معدات طبية حديثة'],
        'experienced_team' => ['en' => 'Experienced Medical Team', 'ar' => 'فريق طبي ذو خبرة'],
        'happy_patients' => ['en' => 'Happy Patients', 'ar' => 'مرضى سعداء'],
        'years_experience' => ['en' => 'Years Experience', 'ar' => 'سنوات الخبرة'],
        'emergency_care' => ['en' => 'Emergency Care', 'ar' => 'رعاية الطوارئ'],
        'specializations' => ['en' => 'Specializations', 'ar' => 'تخصصات'],
        'supporting_clients' => ['en' => 'Supporting Clients', 'ar' => 'دعم العملاء'],
        'locations' => ['en' => 'Locations and More coming', 'ar' => 'مواقع والمزيد قادم'],
        
        // Services Section
        'our_medical_services' => ['en' => 'Our Medical Services', 'ar' => 'خدماتنا الطبية'],
        'comprehensive_healthcare' => ['en' => 'Comprehensive healthcare solutions for you and your family', 'ar' => 'حلول رعاية صحية شاملة لك ولعائلتك'],
        'orthopedics' => ['en' => 'Orthopedics', 'ar' => 'جراحة العظام'],
        'orthopedics_desc' => ['en' => 'Specialized care for bones, joints, muscles, and skeletal system disorders', 'ar' => 'رعاية متخصصة للعظام والمفاصل والعضلات واضطرابات الجهاز الهيكلي'],
        'internal_medicine' => ['en' => 'Internal Medicine', 'ar' => 'الطب الباطني'],
        'internal_medicine_desc' => ['en' => 'Comprehensive adult healthcare and management of chronic conditions', 'ar' => 'رعاية صحية شاملة للبالغين وإدارة الحالات المزمنة'],
        'obstetrics_gynecology' => ['en' => 'Obstetrics and Gynecology', 'ar' => 'التوليد وأمراض النساء'],
        'obstetrics_gynecology_desc' => ['en' => 'Complete women\'s health care including pregnancy and reproductive health', 'ar' => 'رعاية صحية متكاملة للنساء بما في ذلك الحمل والصحة الإنجابية'],
        'dermatology' => ['en' => 'Dermatology', 'ar' => 'الأمراض الجلدية'],
        'dermatology_desc' => ['en' => 'Expert skin care and treatment of dermatological conditions', 'ar' => 'رعاية متخصصة للبشرة وعلاج الحالات الجلدية'],
        'pediatrics' => ['en' => 'Pediatrics', 'ar' => 'طب الأطفال'],
        'pediatrics_desc' => ['en' => 'Specialized medical care for infants, children, and adolescents', 'ar' => 'رعاية طبية متخصصة للرضع والأطفال والمراهقين'],
        'radiology' => ['en' => 'Radiology', 'ar' => 'الأشعة التشخيصية'],
        'radiology_desc' => ['en' => 'Advanced imaging services including X-ray, CT, MRI, and ultrasound', 'ar' => 'خدمات تصوير متقدمة تشمل الأشعة السينية والتصوير المقطعي والرنين المغناطيسي والموجات فوق الصوتية'],
        'general_surgery' => ['en' => 'General Surgery', 'ar' => 'الجراحة العامة'],
        'general_surgery_desc' => ['en' => 'Comprehensive surgical procedures and minimally invasive techniques', 'ar' => 'إجراءات جراحية شاملة وتقنيات الجراحة طفيفة التوغل'],
        'ophthalmology' => ['en' => 'Ophthalmology', 'ar' => 'طب العيون'],
        'ophthalmology_desc' => ['en' => 'Complete eye care including vision correction and eye surgery', 'ar' => 'رعاية شاملة للعيون تشمل تصحيح البصر وجراحة العيون'],
        'family_medicine' => ['en' => 'Family Medicine', 'ar' => 'طب الأسرة'],
        'family_medicine_desc' => ['en' => 'Primary healthcare for patients of all ages and their families', 'ar' => 'الرعاية الصحية الأولية للمرضى من جميع الأعمار وعائلاتهم'],
        'chest_medicine' => ['en' => 'Chest Medicine', 'ar' => 'طب الصدر'],
        'chest_medicine_desc' => ['en' => 'Respiratory care and treatment of lung and chest conditions', 'ar' => 'رعاية الجهاز التنفسي وعلاج حالات الرئة والصدر'],
        'anesthesia' => ['en' => 'Anesthesia', 'ar' => 'التخدير'],
        'anesthesia_desc' => ['en' => 'Safe and effective anesthesia services for surgical procedures', 'ar' => 'خدمات تخدير آمنة وفعالة للإجراءات الجراحية'],
        'pathology' => ['en' => 'Pathology', 'ar' => 'علم الأمراض'],
        'pathology_desc' => ['en' => 'Accurate diagnostic testing and laboratory services', 'ar' => 'فحوصات تشخيصية دقيقة وخدمات مختبرية'],
        'ent' => ['en' => 'ENT', 'ar' => 'أنف وأذن وحنجرة'],
        'ent_desc' => ['en' => 'Ear, nose, and throat specialist care and treatment', 'ar' => 'رعاية وعلاج متخصص للأذن والأنف والحنجرة'],
        
        // Common
        'required' => ['en' => '*', 'ar' => '*'],
        'healthcare_excellence' => ['en' => 'Healthcare Excellence', 'ar' => 'التميز في الرعاية الصحية'],
        'ma_clinique' => ['en' => 'Ma Clinique', 'ar' => 'عيادتي'],
    ];
    
    public static function get($key, $lang = 'en') {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        // Get language from session, URL parameter, or default to 'en'
        if (isset($_GET['lang'])) {
            $lang = $_GET['lang'];
            $_SESSION['language'] = $lang;
        } elseif (isset($_SESSION['language'])) {
            $lang = $_SESSION['language'];
        }
        
        // Validate language
        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }
        
        return isset(self::$translations[$key][$lang]) ? self::$translations[$key][$lang] : $key;
    }
    
    public static function getCurrentLanguage() {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['language']) ? $_SESSION['language'] : 'en';
    }
    
    public static function isRTL() {
        return self::getCurrentLanguage() === 'ar';
    }
}

// Helper function for easier usage
function t($key, $lang = null) {
    return Translation::get($key, $lang);
}

function getCurrentLang() {
    return Translation::getCurrentLanguage();
}

function isRTL() {
    return Translation::isRTL();
}
?>