@extends('backend.main')

@section('content')

    {{-- @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif --}}


    <table class="table table-bordered mt-5 text-center">
        <thead >
        <tr >
            <th scope="col">Serial</th>
            <th scope="col">User Email</th>
            {{-- <th scope="col">Address</th> --}}
            <th scope="col">Paid Amount</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Transaction Id</th>
            <th scope="col">Payment Contact No</th>
            <th scope="col" >PaymentStatus</th>
            <th scope="col">Payment</b>Action</th>
            <th scope="col">Status</th>
            <th scope="col">View</th>

        </thead>
        <tbody>
{{-- @dd($orders); --}}
@foreach( $orders as $key=>$request)

{{-- @dd($request); --}}
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$request->user->email}}</td>
              <td>{{$request->payment_amount}}</td>
              <td>{{$request->payment_method}}</td>
              <td>{{$request->t_id}}</td>
              <td>{{$request->t_phone}}</td>
              {{-- <td>{{$request->address}}</td> --}}

              <td class="text-center">{{$request->paid_status}}</td>

              <td>
                    <div class="dropdown ">
                        {{-- @if ( $request->status == 'paid')
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                     <li>
                        @if ( $request->status == 'paid')
                        <a class="btn btn-warning" href="{{route('orderPaid',['id'=>$request->id,'status'=>'paid'])}}">paid</a>
                     </li>
                        </ul> --}}
                        @if ( $request->status == 'pending')
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Action
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                     <li>

                        <a class="btn" href="{{route('orderPaid',['id'=>$request->id,'status'=>'paid'])}}">paid</a>

                        <a class="btn" href="{{route('orderPaid',['id'=>$request->id,'status'=>'unpaid'])}}">cancle</a>
                     </li>
                        </ul>
                        @else
                        <a href="" class="btn btn-outline-primary">Order Confirmed</a>
                @endif
                    </div>
            </td>


              <td>{{$request->status}}</td>


                     <td>
                         <a href="{{route('adminOrderView',$request->id)}}"><i class="fas fa-eye"></i>
                            {{-- < href=""><i class="far fa-edit"></i> --}}


                         </a>

                     </td>

        </tr>




@endforeach

        </tbody>

    </table>

@endsection
