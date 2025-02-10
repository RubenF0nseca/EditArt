<!DOCTYPE html>
<html>
<head>
    <title>{{ __('admin.title') }}</title>
</head>
<body>
<h1>{{__('emails.greeting', ['name' => $name]) }}</h1>
<p>{{ $content }}</p>
<p>{{__('admin.success_message') }}</p>
</body>
</html>
