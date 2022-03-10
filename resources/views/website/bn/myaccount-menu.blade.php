<ul class="list-group left-menu">
    <li @if(request()->segments()[0]=='my-account') class="active" @endif><a href="{{url('my-account')}}">আমার একাউন্ট</a></li>
    <li @if(request()->segments()[0]=='orders') class="active" @endif><a href="{{url('orders')}}">আমার অর্ডার</a></li>
    <li @if(request()->segments()[0]=='points') class="active" @endif><a href="{{url('points')}}">পয়েন্টস</a></li>
    <li><a href="#">আয় করার প্রোগ্রাম</a></li>
    <li><a href="#">পাসওয়ার্ড পরিবর্তন</a></li>
    <li><a href="#">মোবাইল নাম্বার পরিবর্তন</a></li>
    <li><a href="#">ডেলিভারি ঠিকানা পরিবর্তন</a></li>
    <li class="last"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">লগআউট</a></li>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
</ul>