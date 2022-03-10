@section('title')
CHICKFRESH - Contact Us
@endsection
@section('description')
<meta name="description" content="CHICKFRESH is an Indian Restaurant of Halal Food">
@endsection


@include('partials._header')


<!-- breadcrumb start -->
<div class="breadcrumb-main ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb-contain">
                    <div>
                        <h2>Contact Us</h2>
                        <ul>
                            <li><a href="{{url('/')}}">home</a></li>
                            <li><i class="fa fa-angle-double-right"></i></li>
                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->



<!--section start-->
<section class="contact-page section-big-py-space bg-light">
    <div class="custom-container">
        <div class="row section-big-pb-space">
            <div class="col-xl-6 offset-xl-3">
                <h3 class="text-center mb-3">Get in touch</h3>
                <form class="theme-form">
                    <div class="form-row">
                        <div class="col-md-6">
                           <div class="form-group">
                               <label for="name">First Name</label>
                               <input type="text" class="form-control" id="name" placeholder="Enter Your name" required="">
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="email">Last Name</label>
                              <input type="text" class="form-control" id="last-name" placeholder="Last Name" required="">
                          </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                               <label for="review">Phone number</label>
                               <input type="text" class="form-control" id="review" placeholder="Enter your number" required="">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label for="review">Write Your Message</label>
                                <textarea class="form-control" placeholder="Write Your Message" id="exampleFormControlTextarea1" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-normal" type="submit">Send Your Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br/>
        <br/>
        <div class="row">
            <div class="col-lg-12 map">
                <div class="theme-card">
                <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=3418-A%20Annapolis%20Rd%20Baltimore,%20MD%2021227+(ChickFresh)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"  allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-3">
                <h3>ChickFresh Contact Information</h3>

                <br/><br/>
                Chickfresh is one of the best restaurant till now in Annapolis, we offering every guest personalized
                service pride through care and attention.
                Taste, ambiance and personalize service is key to our success.
                <br/>
                <br/>
                <br/>

                Telephone: 410-589-5338
                <br/><br/>
                E mail: hello@chickfresh-a.com
                <br/><br/>

                3418-A Annapolis Rd
                Baltimore, MD 21227
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

@include('partials._footer')
</body>
</html>
