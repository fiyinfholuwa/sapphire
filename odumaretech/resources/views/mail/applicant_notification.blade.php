
<div  style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border-radius:20px; background-color:#EDE9E8; box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px; color:black; ">
    <div style="text-align:center">
        <img style="width:100px; height:100px; border-radius:50%;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Logo_of_Twitter.svg/2491px-Logo_of_Twitter.svg.png"/>
    </div>

@if($mailData['status'] == "approved" )
<p>{{ $mailData['message'] }}</p>
</br>
<p style="font-weight:600;">Password: {{ $mailData['password'] }}</p>
<p style="font-weight:600;">Email: {{ $mailData['email'] }}</p>

@else
<p>{{ $mailData['message'] }}</p>
@endif
    
</div>