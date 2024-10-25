<x-mail::message>
# Bienvenue sur {{ config('app.name') }}

Lorem ipsum dolor sit amet consectetur adipisicing elit. 

Corrupti aut temporibus consequuntur molestiae soluta repellendus omnis dolor adipisci explicabo beatae rem officia repudiandae mollitia ipsum quia, unde hic! Quaerat, eligendi?

Voici vos codes d'invitation :
@foreach ($codes as $code)
- {{ $code }}
@endforeach

Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate a tenetur quibusdam tempora. Eius ipsum voluptatibus accusantium exercitationem libero cum consequatur sit, sapiente ea officia pariatur maiores inventore impedit.

<x-mail::button :url="$url">
Se rendre sur {{ config('app.name') }}
</x-mail::button>

A bientôt sur {{ config('app.name') }}.
</x-mail::message>