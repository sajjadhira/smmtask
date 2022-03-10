<ul class="list-group left-menu">
    <li><a href="{{url('my-account')}}" @if(request()->segments()[0]=='my-account')class="active" @endif>Profile</a></li>
    <li><a href="{{url('deposit')}}" @if(request()->segments()[0]=='deposit')class="active" @endif>Deposit Balance</a></li>
    <li><a href="{{url('newtask')}}" @if(request()->segments()[0]=='newtask')class="active" @endif>Publish a Tasks</a></li>
    <li><a href="{{url('mytasks')}}" @if(request()->segments()[0]=='mytasks')class="active" @endif>My Tasks</a></li>
    <li><a href="{{url('downloads')}}" @if(request()->segments()[0]=='downloads')class="active" @endif>Completed Tasks</a></li>
    <li><a href="{{url('convert')}}" @if(request()->segments()[0]=='convert')class="active" @endif>Convert Points</a></li>
    <li><a onclick="return confirm('Do you wanna make a withdraw request?')" href="{{url('withdraw')}}" @if(request()->segments()[0]=='withdraw')class="active" @endif>Withdraw Balance</a></li>
    <li><a href="{{url('transactions')}}" @if(request()->segments()[0]=='transactions')class="active" @endif>Transactions</a></li>
    <li><a href="{{url('payment-method')}}" @if(request()->segments()[0]=='payment-method')class="active" @endif>Payment Method</a></li>
    <li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Logout</a></li>
</ul>