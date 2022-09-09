@extends(activeTemplate().'layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">

                <div class="card-header">Payment Preview</div>


                <div class="card-body">

                <button type="button" class="btn btn-success" id="btn-confirm">Pay Now</button>


                </div>


            </div>



        </div>
    </div>
@endsection

@section('js')

    <script src="//voguepay.com/js/voguepay.js"></script>
    <script>
        closedFunction = function() {

        }
        successFunction = function(transaction_id) {
{{--            var alert =  "{{session()->flash('success','Transaction Successful')}}";--}}
                window.location.href = '{{ route('user.deposit') }}';
        }
        failedFunction=function(transaction_id) {
{{--            var alert =  "{{session()->flash('danger','Transaction Failed')}}";--}}
                window.location.href = '{{ route('user.deposit') }}' ;
        }

        function pay(item, price) {
            //Initiate voguepay inline payment
            Voguepay.init({
                v_merchant_id: "{{ $data->v_merchant_id}}",
                total: price,
                notify_url: "{{ $data->notify_url }}",
                cur: "{{$data->cur}}",
                merchant_ref: "{{ $data->merchant_ref }}",
                memo:"{{$data->memo}}",
                recurrent: true,
                frequency: 10,
                developer_code: '5af93ca2913fd',
                store_id:"{{ $data->store_id }}",
                custom: "{{ $data->custom }}",

                closed:closedFunction,
                success:successFunction,
                failed:failedFunction
            });
        }

        $(document).ready(function () {
            $(document).on('click', '#btn-confirm', function (e) {
                e.preventDefault();
                pay('Buy', {{ $data->Buy }});
            });
        });
    </script>

@stop
