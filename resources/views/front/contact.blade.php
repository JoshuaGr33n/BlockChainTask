
@extends('include.front')
@section('content')


 <div class="helpdesk-search section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="helpdesk-search-content">
                    <p class="mb-1">Send us a message we listen</p>
                    <h2 class="mb-5">{{__($page_title)}}</h2>

                </div>
            </div>
        </div>
    </div>
</div>


   <div class="contact-form section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="section-title text-center">
                            <span>Ask Question</span>
                            <h2>Let us hear from you directly!</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-12">
                        <div class="info-list">
                            <h4 class="mb-3">Address</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i>  @php echo  $contact->value->contact_details @endphp</li>
                                <li><i class="fa fa-phone"></i>  @php echo  $contact->value->contact_number @endphp</li>
                                <li><i class="fa fa-envelope"></i> @php echo  $contact->value->email_address @endphp</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8 col-sm-12">
                     <form method="post" class="contact_validate" action="">
                                        @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Full name
                                        </label>
                                        <input type="text" class="form-control" id="contactName" placeholder="Full name"
                                            name="name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="hello@domain.com">

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Phone
                                        </label>
                                        <input type="number" class="form-control" name="phone"
                                            placeholder="+1-768923-731">

                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Subject
                                        </label>
                                        <input type="email" class="form-control" name="subject"
                                            placeholder="Message Subject">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control p-3" name="message" rows="5"
                                            placeholder="Tell us what we can help you with!"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-4 py-2"  style="background-color: {{$general->bclr}}">
                                Send message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12 p-0">
            <div id="map-canvas"></div>
        </div>
    </div>





@endsection
