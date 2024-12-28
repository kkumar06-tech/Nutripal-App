<!-- resources/views/emails/verification_plain.blade.php -->
Hello {{ $user->name }},

Thank you for registering with us. Please use the following verification code to verify your email:

{{ $verificationCode }}

This code will expire in 5 minutes. Please use it as soon as possible to verify your email address.

If you did not request this, please ignore this message.

Best regards,  
The {{ config('app.name') }} Team