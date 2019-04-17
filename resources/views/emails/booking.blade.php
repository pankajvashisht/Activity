@component('mail::message')
# Booking Details

Your slot booked for ({{ $booking[0]['booking']['game']['name'] }})

<div class="container">
        <h5 class="text-center">My Bookings</h5>
        <hr>
      <div class="card mb-4">
          <div class="card-header text-white bg-info">
              <b> Game Name </b> {{$booking[0]['booking']['game']['name']}} <br>
              <hr>
              <span class="float-right"><b>Playing Date </b> {{date('d-m-Y',$booking[0]['booking']['booking_date'])}}</span>
          </div>
          <div class="card-body">
              <hr>
              <b>Booked By </b> : {{$booking[0]['booking']['user']['name']}}
              <hr>
              <b>Slot </b> : {{$booking[0]['booking']['slot']['to']}} - {{$booking[0]['booking']['slot']['from']}}
              <hr>
              <Span class="text-center"><h4>Players</h4></Span>
              @foreach($booking as $k =>  $user)
              <div class="user-detail-col">
                  <span class="user-count"> </span> {{$k+1}} <span><img class="rounded" src="{{$user['user']['social_image']}}" height="30px" width="30px"/> <h6>{{$user['user']['name']}}</h6></span> <br>
                 
              </div>
              @endforeach
          </div>
          
      </div>
     </div> 

Thanks,<br>
{{ config('app.name') }}
@endcomponent
<style>
  .user-detail-col {
    display: flex;
    width: 100%;
    flex-flow: row;
    margin: 0 0 20px;
  }
  .user-detail-col img {
      margin: 0 15px;
  }
  .user-detail-col span {
      display: flex;
  }
</style>
