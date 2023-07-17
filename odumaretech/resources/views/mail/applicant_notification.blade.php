<div class="container">

@if($mailData['status'] == "approved" )
<p>{{ $mailData['message'] }}</p>
</br>

<p>{{ $mailData['password'] }}</p>
@else
<p>{{ $mailData['message'] }}</p>
@endif
    
</div>