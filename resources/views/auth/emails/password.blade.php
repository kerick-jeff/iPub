<!-- The user clicks on this link to reset their passoword.
     A token is passed when the user clicks the link provided
-->
<h2 style="color:rgba(51,122,183,1);">iPub</h2>
Click here to reset your password:
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
