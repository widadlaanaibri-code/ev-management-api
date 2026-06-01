@component('mail::message')
# Your Request Accepted

Dear {{ $user->name }},

Your request to become an organizer has been accepted. You are now an organizer on our platform!

Thank you for joining us.

Regards,<br>
<span class="text-danger">Evento</span>
@endcomponent
