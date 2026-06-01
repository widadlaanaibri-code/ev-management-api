@component('mail::message')
# Welcome to Our Platform

Dear {{ $user->name }},

Thank you for registering as an organizer on our platform. Your account has been created successfully!

Here are your registration details:

- **Name:** {{ $user->name }}
- **Email:** {{ $user->email }}
- **Establishment:** {{ $user->establishment->name }}

We're excited to have you on board!

Regards,<br>
<span class="text-danger">Evento</span>
@endcomponent
