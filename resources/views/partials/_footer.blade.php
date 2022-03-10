
	
	<!-- footer section starts from here -->
	<footer>

        <div class="footer-bottom">
            <span>&copy; {{date("Y")}} <span class="inihub">smmtask</span>. All Rights Reserved.</span>
        </div>
        
</footer>
<!-- footer section ends here -->


<a href="#top" class="cd-top">Top</a>


<form id="logout-form" action="{{url('logout')}}" method="POST" style="d-none">
@csrf
</form>

@include('partials._foot')
