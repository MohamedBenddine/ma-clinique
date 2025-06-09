<?php
class Translation {
    private static $translations = [
        // Navigation
        'about' => ['en' => 'About', 'ar' => 'من نحن'],
        'check_appointment' => ['en' => 'Check Appointment', 'ar' => 'تحقق من الموعد'],
        'appointment' => ['en' => 'Appointment', 'ar' => 'حجز موعد'],
        'contact' => ['en' => 'Contact', 'ar' => 'اتصل بنا'],
        'doctor_login' => ['en' => 'Doctor Portal', 'ar' => 'بوابة الطبيب'],
        'ma_clinique' => ['en' => 'Ma Clinique', 'ar' => 'Ma Clinique'],
        'healthcare_excellence' => ['en' => 'Healthcare Excellence', 'ar' => 'Healthcare Excellence'],
        'phone_invalid' => ['en' => 'Invalid phone number format', 'ar' => 'تنسيق رقم الهاتف غير صالح'],

        // Check Appointment Page
        'check_appointment_title' => ['en' => 'Check Appointment Status - Medical Care', 'ar' => 'فحص حالة الموعد - الرعاية الطبية'],
        'check_your_appointment' => ['en' => 'Check Your Appointment', 'ar' => 'تحقق من موعدك'],
        'track_appointment_status' => ['en' => 'Track your appointment status quickly and easily', 'ar' => 'تتبع حالة موعدك بسرعة وسهولة'],
        'search_appointment' => ['en' => 'Search Appointment', 'ar' => 'البحث عن موعد'],
        'search_appointment_subtitle' => ['en' => 'Enter your appointment number, name, or mobile number', 'ar' => 'أدخل رقم الموعد أو الاسم أو رقم الهاتف المحمول'],
        'search_placeholder' => ['en' => 'Enter appointment number, name, or mobile number...', 'ar' => 'أدخل رقم الموعد أو الاسم أو رقم الهاتف المحمول...'],
        'search' => ['en' => 'Search', 'ar' => 'بحث'],
        'search_results_for' => ['en' => 'Search Results for', 'ar' => 'نتائج البحث عن'],
        'no_appointments_found' => ['en' => 'No appointments found', 'ar' => 'لم يتم العثور على مواعيد'],
        'no_records_found' => ['en' => 'No records found matching', 'ar' => 'لم يتم العثور على سجلات تطابق'],
        'check_search_term' => ['en' => 'Please check your search term and try again.', 'ar' => 'يرجى التحقق من مصطلح البحث والمحاولة مرة أخرى.'],
        
        // General Appointment Details (used in check-appointment and ticket)
        'appointment_details' => ['en' => 'Appointment Details', 'ar' => 'تفاصيل الموعد'],
        'appointment_number' => ['en' => 'Appointment Number', 'ar' => 'رقم الموعد'],
        'patient_name' => ['en' => 'Patient Name', 'ar' => 'اسم المريض'], // Can be same as full_name_label
        'mobile_number' => ['en' => 'Mobile Number', 'ar' => 'رقم الهاتف المحمول'], // Can be same as phone_label
        'email_address' => ['en' => 'Email', 'ar' => 'البريد الإلكتروني'], // Can be same as email_label
        'appointment_date' => ['en' => 'Appointment Date', 'ar' => 'تاريخ الموعد'], // Can be same as date_label
        'appointment_time' => ['en' => 'Appointment Time', 'ar' => 'وقت الموعد'],
        'doctor_name' => ['en' => 'Doctor', 'ar' => 'الطبيب'], // Can be same as doctor_label
        'specialization' => ['en' => 'Specialization', 'ar' => 'التخصص'], // Can be same as specialization_label
        'doctors_remark' => ['en' => 'Doctor\'s Remark', 'ar' => 'ملاحظة الطبيب'],
        'appointment_status' => ['en' => 'Status', 'ar' => 'الحالة'],
        
        // Status Labels
        'status_approved' => ['en' => 'Approved', 'ar' => 'موافق عليه'],
        'status_pending' => ['en' => 'Pending', 'ar' => 'في انتظار الموافقة'],
        'status_cancelled' => ['en' => 'Cancelled', 'ar' => 'ملغي'],
        'status_rejected' => ['en' => 'Rejected', 'ar' => 'مرفوض'],
        'status_completed' => ['en' => 'Completed', 'ar' => 'مكتمل'],

        // Booking Form Specific
        'book_appointment_title' => ['en' => 'Book an Appointment - Medical Care', 'ar' => 'احجز موعد - الرعاية الطبية'],
        'book_an_appointment' => ['en' => 'Book an Appointment', 'ar' => 'احجز موعد'],
        'schedule_your_visit' => ['en' => 'Schedule your visit with our healthcare professionals', 'ar' => 'حدد موعد زيارتك مع أخصائيي الرعاية الصحية لدينا'],
        'fill_form_carefully' => ['en' => 'Please fill out the form below carefully.', 'ar' => 'يرجى ملء النموذج أدناه بعناية.'],
        'who_are_you' => ['en' => 'Who are you?', 'ar' => 'من أنت؟'],
        'select_user_type' => ['en' => 'Select user type', 'ar' => 'اختر نوع المستخدم'],
        'new_appointment' => ['en' => 'New appointment', 'ar' => 'موعد جديد'],
        'already_booked' => ['en' => 'Already booked', 'ar' => 'تم الحجز مسبقاً'],
        'inquiry' => ['en' => 'Inquiry', 'ar' => 'استفسار'],
        'full_name_label' => ['en' => 'Full Name', 'ar' => 'الاسم الكامل'],
        'full_name_placeholder' => ['en' => 'Enter your full name', 'ar' => 'أدخل اسمك الكامل'],
        'email_label' => ['en' => 'Email Address', 'ar' => 'عنوان البريد الإلكتروني'],
        'email_placeholder' => ['en' => 'Enter your email address', 'ar' => 'أدخل عنوان بريدك الإلكتروني'],
        'phone_label' => ['en' => 'Phone Number', 'ar' => 'رقم الهاتف'],
        'phone_placeholder' => ['en' => 'Enter your phone number', 'ar' => 'أدخل رقم هاتفك'],
        'date_label' => ['en' => 'Appointment Date', 'ar' => 'تاريخ الموعد'],
        'specialization_label' => ['en' => 'Specialization', 'ar' => 'التخصص'],
        'select_specialization' => ['en' => 'Select specialization', 'ar' => 'اختر التخصص'],
        'doctor_label' => ['en' => 'Doctor', 'ar' => 'الطبيب'],
        'select_doctor' => ['en' => 'Select Doctor', 'ar' => 'اختر الطبيب'],
        'submit_appointment' => ['en' => 'Book Appointment', 'ar' => 'احجز الموعد'],
        'processing' => ['en' => 'Processing...', 'ar' => 'جاري المعالجة...'],
        'loading' => ['en' => 'Loading...', 'ar' => 'جاري التحميل...'],
        'error_loading_doctors' => ['en' => 'Error loading doctors', 'ar' => 'خطأ في تحميل الأطباء'],
        'select_specialization_first' => ['en' => 'Select specialization first', 'ar' => 'اختر التخصص أولاً'],

        // Booking Form Validation & Error/Success Messages
        'name_required' => ['en' => 'Full name is required.', 'ar' => 'الاسم الكامل مطلوب.'],
        'phone_required' => ['en' => 'Phone number is required.', 'ar' => 'رقم الهاتف مطلوب.'],
        'email_required' => ['en' => 'A valid email address is required.', 'ar' => 'عنوان بريد إلكتروني صالح مطلوب.'],
        'date_required' => ['en' => 'Appointment date is required.', 'ar' => 'تاريخ الموعد مطلوب.'],
        'specialization_required' => ['en' => 'Specialization is required.', 'ar' => 'التخصص مطلوب.'],
        'doctor_required' => ['en' => 'Doctor is required.', 'ar' => 'الطبيب مطلوب.'],
        'user_type_required' => ['en' => 'User type is required.', 'ar' => 'نوع المستخدم مطلوب.'],
        'date_error' => ['en' => 'Appointment date must be in the future.', 'ar' => 'يجب أن يكون تاريخ الموعد في المستقبل.'],
        'something_wrong' => ['en' => 'Something went wrong. Please try again.', 'ar' => 'حدث خطأ ما. يرجى المحاولة مرة أخرى.'],
        'required_field' => ['en' => 'This field is required', 'ar' => 'هذا الحقل مطلوب'], // Generic, can be used by client-side
        'invalid_email' => ['en' => 'Please enter a valid email address', 'ar' => 'يرجى إدخال عنوان بريد إلكتروني صالح'],
        'invalid_phone' => ['en' => 'Please enter a valid phone number', 'ar' => 'يرجى إدخال رقم هاتف صالح'],

        // Ticket Page Specific
        'appointment_ticket_title' => ['en' => 'Appointment Ticket - Medical Care', 'ar' => 'تذكرة الموعد - الرعاية الطبية'],
        'appointment_confirmed_title' => ['en' => 'Appointment Confirmed!', 'ar' => 'تم تأكيد الموعد!'],
        'appointment_confirmed_subtitle' => ['en' => 'Your appointment has been successfully booked.', 'ar' => 'لقد تم حجز موعدك بنجاح.'],
        'your_appointment_number_is' => ['en' => 'Your Appointment Number is:', 'ar' => 'رقم موعدك هو:'],
        'patient_details' => ['en' => 'Patient Details', 'ar' => 'تفاصيل المريض'],
        'clinic_location' => ['en' => 'Clinic Location', 'ar' => 'موقع العيادة'],
        'print_ticket' => ['en' => 'Print Ticket', 'ar' => 'اطبع التذكرة'],
        'back_to_home' => ['en' => 'Back to Home', 'ar' => 'العودة للرئيسية'],
        'error_fetching_appointment_details' => ['en' => 'Error: Could not retrieve appointment details.', 'ar' => 'خطأ: لم نتمكن من استرداد تفاصيل الموعد.'],
        'clinic_address_not_found' => ['en' => 'Clinic address not available.', 'ar' => 'عنوان العيادة غير متوفر.'],
        'maps_link_print_hint' => ['en' => 'The map link will not be active on the printed version.', 'ar' => 'لن يكون رابط الخريطة نشطًا في النسخة المطبوعة.'],
        
        // Common Buttons & Links
        'back_to_home' => ['en' => 'Back to Home', 'ar' => 'العودة للرئيسية'],
        'continue' => ['en' => 'Continue', 'ar' => 'متابعة'],
        'learn_more' => ['en' => 'LEARN MORE', 'ar' => 'اعرف المزيد'],
        'book_now' => ['en' => 'BOOK NOW', 'ar' => 'احجز الآن'],
        'call_now' => ['en' => 'Call Now', 'ar' => 'اتصل الآن'],

        // Other sections from your provided file (condensed for brevity, ensure all your keys are present)
        'health_care_available' => ['en' => 'HEALTH CARE AVAILABLE', 'ar' => 'الرعاية الصحية متاحة'],
        'medical_services_terms' => ['en' => '*Professional medical services available, contact us for appointment details.', 'ar' => '*خدمات طبية مهنية متاحة، اتصل بنا لتفاصيل المواعيد.'],
        'about_title' => ['en' => 'About us', 'ar' => 'من نحن'],
        'mission_statement' => ['en' => 'Our mission declares our purpose of existence as a healthcare technology solution and our objectives.', 'ar' => 'تعلن مهمتنا عن هدف وجودنا كحل تقني للرعاية الصحية وأهدافنا.'],
        'mission_description' => ['en' => 'To provide every user — whether patient or doctor — much more than expected in terms of usability, accessibility, data security, and personalized service, by understanding local healthcare needs and continuously innovating to ultimately deliver an unmatched experience in medical appointment scheduling through ob-doc-web.', 'ar' => 'تقديم أكثر مما هو متوقع لكل مستخدم - سواء كان مريضاً أو طبيباً - من حيث سهولة الاستخدام وإمكانية الوصول وأمان البيانات والخدمة الشخصية، من خلال فهم احتياجات الرعاية الصحية المحلية والابتكار المستمر لتقديم تجربة لا مثيل لها في جدولة المواعيد الطبية.'],
        'clinic_license' => ['en' => '3 Licence', 'ar' => '3 ليسانس'],
        'clinic_name' => ['en' => 'Benddine-Ouarnoughi', 'ar' => 'بن الدين - ورنوغي '],
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
        
        // Medical Remarks Translations
        'remark_approved_ready' => ['en' => 'Your appointment has been approved. Please arrive 15 minutes early.', 'ar' => 'تم الموافقة على موعدك. يرجى الحضور قبل 15 دقيقة من الموعد.'],
        'remark_cancelled_patient' => ['en' => 'Appointment cancelled by patient request.', 'ar' => 'تم إلغاء الموعد بناءً على طلب المريض.'],
        'remark_cancelled_doctor' => ['en' => 'Appointment cancelled due to doctor unavailability.', 'ar' => 'تم إلغاء الموعد بسبب عدم توفر الطبيب.'],
        'remark_rescheduled' => ['en' => 'Appointment has been rescheduled. New date will be communicated.', 'ar' => 'تم إعادة جدولة الموعد. سيتم إبلاغكم بالتاريخ الجديد.'],
        'remark_completed_successful' => ['en' => 'Appointment completed successfully. Follow-up scheduled.', 'ar' => 'تم إنجاز الموعد بنجاح. تم جدولة متابعة.'],
        'remark_pending_review' => ['en' => 'Your appointment is under review. We will contact you soon.', 'ar' => 'موعدك قيد المراجعة. سنتواصل معك قريباً.'],
        'remark_bring_documents' => ['en' => 'Please bring your medical documents and insurance card.', 'ar' => 'يرجى إحضار الوثائق الطبية وبطاقة التأمين.'],
        'remark_fasting_required' => ['en' => 'Fasting required 12 hours before appointment.', 'ar' => 'مطلوب صيام 12 ساعة قبل الموعد.'],
        'remark_emergency_contact' => ['en' => 'For emergency, please contact: +213-XXX-XXXX', 'ar' => 'في حالة الطوارئ، يرجى الاتصال: +213-XXX-XXXX'],
        'remark_prescription_ready' => ['en' => 'Your prescription is ready for pickup.', 'ar' => 'وصفتك الطبية جاهزة للاستلام.'],
        
        // Common medical terms that might appear in remarks
        'urgent' => ['en' => 'Urgent', 'ar' => 'عاجل'],
        'follow_up' => ['en' => 'Follow-up', 'ar' => 'متابعة'],
        'consultation' => ['en' => 'Consultation', 'ar' => 'استشارة'],
        'examination' => ['en' => 'Examination', 'ar' => 'فحص'],
        'treatment' => ['en' => 'Treatment', 'ar' => 'علاج'],
        'medication' => ['en' => 'Medication', 'ar' => 'دواء'],
        'test_results' => ['en' => 'Test Results', 'ar' => 'نتائج الفحص'],
        'blood_test' => ['en' => 'Blood Test', 'ar' => 'فحص دم'],
        'x_ray' => ['en' => 'X-Ray', 'ar' => 'أشعة سينية'],
        'mri' => ['en' => 'MRI', 'ar' => 'رنين مغناطيسي'],
        'surgery' => ['en' => 'Surgery', 'ar' => 'جراحة'],
        'emergency' => ['en' => 'Emergency', 'ar' => 'طوارئ'],
        
        // Booking Form Translations - NEW
        'book_appointment_title' => ['en' => 'Book an Appointment - Medical Care', 'ar' => 'احجز موعد - الرعاية الطبية'],
        'book_an_appointment' => ['en' => 'Book an Appointment', 'ar' => 'احجز موعد'],
        'schedule_your_visit' => ['en' => 'Schedule your visit with our healthcare professionals', 'ar' => 'حدد موعد زيارتك مع أخصائيي الرعاية الصحية لدينا'],
        'who_are_you' => ['en' => 'Who are you?', 'ar' => 'من أنت؟'],
        'new_appointment' => ['en' => 'New appointment', 'ar' => 'موعد جديد'],
        'already_booked' => ['en' => 'Already booked', 'ar' => 'تم الحجز مسبقاً'],
        'inquiry' => ['en' => 'Inquiry', 'ar' => 'استفسار'],
        'full_name_label' => ['en' => 'Full Name', 'ar' => 'الاسم الكامل'],
        'full_name_placeholder' => ['en' => 'Enter your full name', 'ar' => 'أدخل اسمك الكامل'],
        'email_label' => ['en' => 'Email Address', 'ar' => 'عنوان البريد الإلكتروني'],
        'email_placeholder' => ['en' => 'Enter your email address', 'ar' => 'أدخل عنوان بريدك الإلكتروني'],
        'phone_label' => ['en' => 'Phone Number', 'ar' => 'رقم الهاتف'],
        'phone_placeholder' => ['en' => 'Enter your phone number', 'ar' => 'أدخل رقم هاتفك'],
        'date_label' => ['en' => 'Appointment Date', 'ar' => 'تاريخ الموعد'],
        'specialization_label' => ['en' => 'Specialization', 'ar' => 'التخصص'],
        'select_specialization' => ['en' => 'Select specialization', 'ar' => 'اختر التخصص'],
        'doctor_label' => ['en' => 'Doctor', 'ar' => 'الطبيب'],
        'select_doctor' => ['en' => 'Select Doctor', 'ar' => 'اختر الطبيب'],
        'submit_appointment' => ['en' => 'Book Appointment', 'ar' => 'احجز الموعد'],
        'processing' => ['en' => 'Processing...', 'ar' => 'جاري المعالجة...'],
        
        // Success/Error Messages
        'appointment_success' => ['en' => 'Appointment Booked Successfully!', 'ar' => 'تم حجز الموعد بنجاح!'],
        'appointment_success_message' => ['en' => 'Your appointment request has been submitted. We will contact you soon to confirm your appointment.', 'ar' => 'تم إرسال طلب الموعد. سنتواصل معك قريباً لتأكيد موعدك.'],
        'appointment_number' => ['en' => 'Your appointment number is:', 'ar' => 'رقم موعدك هو:'],
        'date_error' => ['en' => 'Appointment date must be greater than today\'s date.', 'ar' => 'يجب أن يكون تاريخ الموعد أكبر من تاريخ اليوم.'],
        'something_wrong' => ['en' => 'Something went wrong. Please try again.', 'ar' => 'حدث خطأ ما. يرجى المحاولة مرة أخرى.'],
        'continue' => ['en' => 'Continue', 'ar' => 'متابعة'],
        'back_to_home' => ['en' => 'Back to Home', 'ar' => 'العودة للرئيسية'],
        
        // Form Validation
        'required_field' => ['en' => 'This field is required', 'ar' => 'هذا الحقل مطلوب'],
        'invalid_email' => ['en' => 'Please enter a valid email address', 'ar' => 'يرجى إدخال عنوان بريد إلكتروني صالح'],
        'invalid_phone' => ['en' => 'Please enter a valid phone number', 'ar' => 'يرجى إدخال رقم هاتف صالح'],
        
        // ... rest of existing translations ...
    ];
    
    public static function get($key, $lang = null) { // Changed $lang default to null
        if (!isset($_SESSION)) {
            @session_start(); // Use @ to suppress errors if session already started
        }
        
        // Determine language: 1. Parameter, 2. Session, 3. Default 'en'
        if ($lang === null) { // Only use session or default if no specific lang passed
            if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ar'])) {
                $current_lang = $_GET['lang'];
                $_SESSION['language'] = $current_lang;
            } elseif (isset($_SESSION['language']) && in_array($_SESSION['language'], ['en', 'ar'])) {
                $current_lang = $_SESSION['language'];
            } else {
                $current_lang = 'en'; // Default language
            }
        } else {
            $current_lang = in_array($lang, ['en', 'ar']) ? $lang : 'en'; // Use passed lang if valid
        }
        
        return isset(self::$translations[$key][$current_lang]) ? self::$translations[$key][$current_lang] : $key;
    }
    
    public static function getCurrentLanguage() {
        if (!isset($_SESSION)) {
            @session_start();
        }
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ar'])) {
            $_SESSION['language'] = $_GET['lang'];
            return $_GET['lang'];
        }
        return isset($_SESSION['language']) && in_array($_SESSION['language'], ['en', 'ar']) ? $_SESSION['language'] : 'en';
    }
    
    public static function isRTL() {
        return self::getCurrentLanguage() === 'ar';
    }
    
    public static function translateRemark($remark, $targetLang = null) {
        if (!$targetLang) {
            $targetLang = self::getCurrentLanguage();
        }
        
        foreach (self::$translations as $key => $translations) {
            if (strpos($key, 'remark_') === 0) {
                foreach ($translations as $lang => $text) {
                    if ($lang !== $targetLang && strcasecmp(trim($remark), trim($text)) === 0) {
                        return $translations[$targetLang] ?? $remark; // Return translation if original remark matches
                    }
                }
                 // If the remark itself is a key (e.g. 'remark_approved_ready' was passed as $remark)
                if ($key === $remark) {
                    return $translations[$targetLang] ?? $remark;
                }
            }
        }
        
        $translatedRemark = $remark;
        foreach (self::$translations as $key => $translations) {
            if (!strpos($key, 'remark_') === 0 && isset($translations[$targetLang])) { // Ensure target translation exists
                // Try to find non-target language version of the term to replace
                foreach ($translations as $lang => $text) {
                    if ($lang !== $targetLang && !empty($text) && stripos($translatedRemark, $text) !== false) {
                         // More precise replacement: word boundary, case-insensitive
                        $translatedRemark = preg_replace('/\b' . preg_quote($text, '/') . '\b/iu', $translations[$targetLang], $translatedRemark);
                    }
                }
            }
        }
        return $translatedRemark;
    }
    
    public static function isArabicText($text) {
        return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
    }
}

// Helper functions
function t($key, $lang = null) {
    return Translation::get($key, $lang);
}

function getCurrentLang() {
    return Translation::getCurrentLanguage();
}

function isRTL() {
    return Translation::isRTL();
}

function translateRemark($remark, $targetLang = null) {
    return Translation::translateRemark($remark, $targetLang);
}
?>