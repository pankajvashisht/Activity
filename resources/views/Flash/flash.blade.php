
@if(session('message'))
<div class="alert alert-{{ session('class') }} alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ session('message') }}</strong>
</div>
@endif