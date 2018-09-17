<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | الـ following language lines contain الـ default error messages used by
    | الـ validator class. Some of الـse rules have multiple versions such
    | as الـ size rules. Feel free to tweak each of الـse messages here.
    |
    */

    'accepted'             => 'الـ :attribute يجب قبوله..',
    'active_url'           => 'الـ :attribute ليس عنوان URL صالحًا.',
    'after'                => 'الـ :attribute يجب أن يكون تاريخ بعد :date.',
    'after_or_equal'       => 'الـ :attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha'                => 'الـ :attribute قد تحتوي على أحرف فقط.',
    'alpha_dash'           => 'الـ :attribute قد تحتوي فقط على أحرف وأرقام وشرطات.',
    'alpha_num'            => 'الـ :attribute قد يحتوي فقط على أحرف وأرقام.',
    'array'                => 'الـ :attribute يجب أن تكون مصفوفة.',
    'before'               => 'الـ :attribute يجب أن يكون تاريخ من قبل :date.',
    'before_or_equal'      => 'الـ :attribute يجب أن يكون تاريخًا قبل أو يساوي :date.',
    'between'              => [
        'numeric' => 'الـ :attribute لابد ان تكون بالوسط :min و :max.',
        'file'    => 'الـ :attribute لابد ان تكون بالوسط :min و :max كيلو بايت.',
        'string'  => 'الـ :attribute لابد ان تكون بالوسط :min و :max قد لا يكون أكبر من.',
        'array'   => 'الـ :attribute يجب أن يكون بين :min و :max العناصر.',
    ],
    'boolean'              => 'الـ :attribute يجب أن يكون الحقل صحيحًا أو خطأ.',
    'confirmed'            => 'الـ :attribute التأكيد غير متطابق.',
    'date'                 => 'الـ :attribute هذا ليس تاريخ صحيح.',
    'date_format'          => 'الـ :attribute الشكل غير متطابق :format.',
    'different'            => 'The :attribute و :other يجب أن تكون مختلفة.',
    'digits'               => 'الـ :attribute لا بد وأن :digits الأرقام.',
    'digits_between'       => 'الـ :attribute لابد ان تكون بالوسط :min و :max الأرقام.',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صور غير صالحة.',
    'distinct'             => 'الـ :attribute يحتوي الحقل على قيمة مكررة.',
    'email'                => 'الـ :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'exists'               => 'الـ المحدد :attribute غير صالح.',
    'file'                 => 'الـ :attribute يجب أن يكون ملف.',
    'filled'               => 'الـ :attribute يجب أن يكون الحقل قيمة.',
    'image'                => 'الـ :attribute يجب أن تكون صورة.',
    'in'                   => 'الـ المحدد :attribute غير صالح.',
    'in_array'             => 'The :attribute الحقل غير موجود في :other.',
    'integer'              => 'الـ :attribute يجب أن يكون صحيحا.',
    'ip'                   => 'الـ :attribute يجب أن يكون عنوان IP صالحًا.',
    'json'                 => 'الـ :attribute يجب أن يكون عبارة عن سلسلة JSON صالحة.',
    'max'                  => [
        'numeric' => 'الـ :attribute قد لا يكون أكبر من :max.',
        'file'    => 'الـ :attribute قد لا يكون أكبر من :max كيلو بايت.',
        'string'  => 'الـ :attribute قد لا يكون أكبر من :max قد لا يكون أكبر من.',
        'array'   => 'الـ :attribute قد لا يكون أكثر من :max العناصر.',
    ],
    'mimes'                => 'الـ :attribute يجب أن يكون ملف  type: :values.',
    'mimetypes'            => 'الـ :attribute يجب أن يكون ملف  type: :values.',
    'min'                  => [
        'numeric' => 'الـ :attribute لا بد أن يكون على الأقل :min.',
        'file'    => 'الـ :attribute لا بد أن يكون على الأقل :min كيلو بايت.',
        'string'  => 'الـ :attribute لا بد أن يكون على الأقل :min قد لا يكون أكبر من.',
        'array'   => 'الـ :attribute يجب أن يكون على الأقل :min العناصر.',
    ],
    'not_in'               => 'المحدد  :attribute غير صالح.',
    'numeric'              => 'الـ :attribute يجب أن يكون رقما.',
    'present'              => 'الـ :attribute يجب أن يكون المجال موجودا.',
    'regex'                => 'الـ :attribute التنسيق غير صالح.',
    'required'             => 'الـ :attribute الحقل مطلوب.',
    'required_if'          => ' :attribute الحقل مطلوب عندما :other هو :value.',
    'required_unless'      => ' :attribute field is required unless :other is in :values.',
    'required_with'        => 'الـ :attribute الحقل مطلوب عندما :values موجود.',
    'required_with_all'    => 'الـ :attribute الحقل مطلوب عندما :values موجود.',
    'required_without'     => 'الـ :attribute الحقل مطلوب عندما :values is not present.',
    'required_without_all' => 'الـ :attribute حقل مطلوب عندما لا شيء من :values موجودة.',
    'same'                 => 'ال :attribute و :other يجب أن تتطابق.',
    'size'                 => [
        'numeric' => 'الـ :attribute لا بد وأن :size.',
        'file'    => 'الـ :attribute لا بد وأن :size كيلو بايت.',
        'string'  => 'الـ :attribute لا بد وأن :size قد لا يكون أكبر من.',
        'array'   => 'الـ :attribute يجب أن تحتوي على :size العناصر.',
    ],
    'string'               => 'الـ :attribute يجب أن تكون سلسلة.',
    'timezone'             => 'الـ :attribute يجب أن تكون منطقة صالحة.',
    'unique'               => 'الـ :attribute لقد اتخذت بالفعل.',
    'uploaded'             => 'الـ :attribute فشل في التحميل.',
    'url'                  => 'الـ :attribute التنسيق غير صالح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using الـ
    | convention "attribute.rule" to name الـ lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | الـ following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
