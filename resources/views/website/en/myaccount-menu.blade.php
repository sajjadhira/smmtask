<ul class="list-group left-menu">
    <li @if(request()->segments()[0]=='my-account') class="active" @endif><a href="{{url('my-account')}}">My Account</a></li>
    <li @if(request()->segments()[0]=='orders') class="active" @endif><a href="{{url('orders')}}">My Orders</a></li>
    <li @if(request()->segments()[0]=='points') class="active" @endif><a href="{{url('points')}}">Points</a></li>
    <li><a href="#">Affiliate Program</a></li>
    <li><a href="#">Change Password</a></li>
    <li><a href="#">Edit Contact Information</a></li>
    <li><a href="#">Edit Billing Address</a></li>
    <li class="last"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Log Out</a></li>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
</ul>