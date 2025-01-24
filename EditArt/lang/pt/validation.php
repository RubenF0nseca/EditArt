<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo ":attribute" deve ser aceite.',
    'accepted_if' => "O campo :attribute deve ser aceite quando :other for :value.",
    'active_url' => 'O campo ":attribute" não é um URL válido.',
    'after' => 'O campo ":attribute" deve ser uma data posterior a :date.',
    'after_or_equal' => 'O campo ":attribute" deve ser uma data posterior ou igual a :date.',
    'alpha' => 'O campo ":attribute" só pode conter letras.',
    'alpha_dash' => 'O campo ":attribute" só pode conter letras, números, ifan e underscore.',
    'alpha_num' => 'O campo ":attribute" só pode conter letras e números.',
    'array' => 'O campo ":attribute" deve ser um array.',
    'ascii' => 'O campo :attribute deve conter apenas caracteres alfanuméricos de byte único e símbolos.',
    'before' => 'O campo ":attribute" deve ser uma data anterior :date.',
    'before_or_equal' => 'O campo ":attribute" deve ser uma data anterior ou igual a :date.',
    'between' => [
        'array' => 'O campo ":attribute" deve ter entre :min e :max itens.',
        'file' => 'O campo ":attribute" deve ser entre :min e :max kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser entre :min e :max.',
        'string' => 'O campo ":attribute" deve ser entre :min e :max caracteres.',
    ],
    'boolean' => 'O campo ":attribute" deve ser verdadeiro ou falso.',
    'can' => 'O campo :attribute contém um valor não autorizado.',
    'confirmed' => 'O campo ":attribute" de confirmação não coincide.',
    'contains' => 'O campo ":attribute" está em falta de um valor obrigatório.',
    'current_password' => 'A palavra-passe está incorreta.',
    'date' => 'O campo ":attribute" não é uma data válida.',
    'date_equals' => 'O campo ":attribute" deve ser uma data igual a :date.',
    'date_format' => 'O campo ":attribute" não corresponde ao formato :format.',
    'decimal' => 'O campo ":attribute" deve ter :decimal casas decimais.',
    'declined' => 'O campo ":attribute" deve ser recusado.',
    'declined_if' => 'O campo ":attribute" deve ser recusado quando :other é :value.',
    'different' => 'Os campos ":attribute" e ":other" devem ser diferentes.',
    'digits' => 'O campo ":attribute" deve ter :digits dígitos.',
    'digits_between' => 'O campo ":attribute" deve ter entre :min e :max dígitos.',
    'dimensions' => 'O campo ":attribute" tem dimensões de imagem inválidas.',
    'distinct' => 'O campo ":attribute" tem um valor duplicado.',
    'doesnt_end_with' => 'O campo ":attribute" não deve terminar com um dos seguintes valores: :values.',
    'doesnt_start_with' => 'O campo ":attribute" não deve começar com um dos seguintes valores: :values.',
    'email' => 'O campo ":attribute" deve ser um endereço de e-mail válido.',
    'ends_with' => 'O campo ":attribute" deve terminar com um de: :values',
    'enum' => 'O campo ":attribute" selecionado é inválido.',
    'exists' => 'O campo ":attribute" selecionado é inválido.',
    'extensions' => 'O campo :attribute deve ter uma das seguintes extensões: :values.',
    'file' => 'O campo ":attribute" deve ser um ficheiro.',
    'filled' => 'O campo ":attribute" deve ter um valor.',
    'gt' => [
        'array' => 'O campo ":attribute" deve conter mais de ":value" itens.',
        'file' => 'O campo ":attribute" deve ser maior que ":value" kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser maior que ":value".',
        'string' => 'O campo ":attribute" deve ser maior que ":value" caracteres.',
    ],
    'gte' => [
        'array' => 'O campo ":attribute" deve conter :value itens ou mais.',
        'file' => 'O campo ":attribute" deve ser maior ou igual a :value kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser maior ou igual a :value.',
        'string' => 'O campo ":attribute" deve ser maior ou igual a :value caracteres.',
    ],
    'hex_color' => 'O campo :attribute deve ser uma cor hexadecimal válida.',
    'image' => 'O campo ":attribute" deve ser uma imagem.',
    'in' => 'O campo ":attribute" selecionado é inválido.',
    'in_array' => 'O campo ":attribute" não existe em ":other".',
    'integer' => 'O campo ":attribute" deve ser um número inteiro.',
    'ip' => 'O campo ":attribute" deve ser um endereço de IP válido.',
    'ipv4' => 'O campo ":attribute" deve ser um endereço IPv4 válido.',
    'ipv6' => 'O campo ":attribute" deve ser um endereço IPv6 válido.',
    'json' => 'O campo ":attribute" deve ser uma string JSON válida.',
    'list' => 'O campo :attribute deve ser uma lista.',
    'lowercase' => 'O campo :attribute deve estar em minúsculas.',
    'lt' => [
        'array' => 'O campo ":attribute" deve conter menos de :value itens.',
        'file' => 'O campo ":attribute" deve ser menor que :value kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser menor que ":value".',
        'string' => 'O campo ":attribute" deve ser menor que :value caracteres.',
    ],
    'lte' => [
        'array' => 'O campo ":attribute" não deve conter mais que :value itens.',
        'file' => 'O campo ":attribute" deve ser menor ou igual a :value kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser menor ou igual a ":value".',
        'string' => 'O campo ":attribute" deve ser menor ou igual a :value caracteres.',
    ],
    'mac_address' => 'O campo :attribute deve ser um endereço MAC válido.',
    'max' => [
        'array' => 'O campo ":attribute" não pode ter mais do que :max itens.',
        'file' => 'O campo ":attribute" não pode ser superior a :max kilobytes.',
        'numeric' => 'O campo ":attribute" não pode ser superior a :max.',
        'string' => 'O campo ":attribute" não pode ser superior a :max caracteres.',
    ],
    'max_digits' => 'O campo :attribute não deve ter mais de :max dígitos.',
    'mimes' => 'O campo ":attribute" deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo ":attribute" deve ser um arquivo do tipo: :values.',
    'min' => [
        'array' => 'O campo ":attribute" deve ter pelo menos :min itens.',
        'file' => 'O campo ":attribute" deve ter pelo menos :min kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser pelo menos :min.',
        'string' => 'O campo ":attribute" deve ter pelo menos :min caracteres.',
    ],
    'min_digits' => 'O campo :attribute deve ter pelo menos :min dígitos.',
    'missing' => 'O campo :attribute deve estar em falta.',
    'missing_if' => 'O campo :attribute deve estar em falta quando :other for :value.',
    'missing_unless' => 'O campo :attribute deve estar em falta, a menos que :other seja :value.',
    'missing_with' => 'O campo :attribute deve estar em falta quando :values estiver presente.',
    'missing_with_all' => 'O campo :attribute deve estar em falta quando :values estiverem presentes.',
    'multiple_of' => 'O campo :attribute deve ser um múltiplo de :value.',
    'not_in' => 'O campo ":attribute" selecionado é inválido.',
    'not_regex' => 'O campo ":attribute" possui um formato inválido.',
    'numeric' => 'O campo ":attribute" deve ser um número.',
    'password' => [
        'letters' => 'O campo :attribute deve conter pelo menos uma letra.',
        'mixed' => 'O campo :attribute deve conter pelo menos uma letra maiúscula e uma letra minúscula.',
        'numbers' => 'O campo :attribute deve conter pelo menos um número.',
        'symbols' => 'O campo :attribute deve conter pelo menos um símbolo.',
        'uncompromised' => 'O :attribute fornecido apareceu numa fuga de dados. Por favor, escolhe um :attribute diferente.',

    ],
    'present' => 'O campo ":attribute" deve estar presente.',
    'present_if' => 'O campo :attribute deve estar presente quando :other for :value.',
    'present_unless' => 'O campo :attribute deve estar presente, a menos que :other seja :value.',
    'present_with' => 'O campo :attribute deve estar presente quando :values estiver presente.',
    'present_with_all' => 'O campo :attribute deve estar presente quando :values estiverem presentes.',
    'prohibited' => 'O campo :attribute é proibido.',
    'prohibited_if' => 'O campo :attribute é proibido quando :other for :value.',
    'prohibited_unless' => 'O campo :attribute é proibido, a menos que :other esteja em :values.',
    'prohibits' => 'O campo :attribute impede que :other esteja presente.',
    'regex' => 'O campo ":attribute" tem um formato inválido.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'O campo :attribute deve conter entradas para: :values.',
    'required_if' => 'O campo ":attribute" é obrigatório quando ":other" for ":value".',
    'required_if_accepted' => 'O campo :attribute é obrigatório quando :other for aceite.',
    'required_if_declined' => 'O campo :attribute é obrigatório quando :other for recusado.',
    'required_unless' => 'O campo ":attribute" é obrigatório exceto quando ":other" for ":values".',
    'required_with' => 'O campo ":attribute" é obrigatório quando ":values" está presente.',
    'required_with_all' => 'O campo ":attribute" é obrigatório quando ":values" está presente.',
    'required_without' => 'O campo ":attribute" é obrigatório quando ":values" não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos seguintes :values está presente.',
    'same' => 'Os campos ":attribute" e ":other" devem corresponder.',
    'size' => [
        'array' => 'O campo ":attribute" deve conter :size itens.',
        'file' => 'O campo ":attribute" deve ser :size kilobytes.',
        'numeric' => 'O campo ":attribute" deve ser :size.',
        'string' => 'O campo ":attribute" deve ser :size caracteres.',
    ],
    'starts_with' => 'O campo ":attribute" deve começar com um dos seguintes valores: :values',
    'string' => 'O campo ":attribute" deve ser uma string.',
    'timezone' => 'O campo ":attribute" deve ser uma zona válida.',
    'unique' => 'O campo ":attribute" já está a ser utilizado.',
    'uploaded' => 'Ocorreu uma falha no upload do campo ":attribute".',
    'uppercase' => 'O campo :attribute deve ser em maiúsculas.',
    'url' => 'O campo :attribute deve ser uma URL válida.',
    'ulid' => 'O campo :attribute deve ser um ULID válido.',
    'uuid' => 'O campo :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'nome-do-atributo' => [
            'regra-de-validacao' => 'Mensagem personalizada em português',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
