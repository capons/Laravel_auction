@extends('main')

@section('title', 'View a promise')

@section('sidebar')
@stop

@section('content')
   <div style="height: 700px" class="col-xs-12">
      <?php if(isset($promise_details)) { ?>
      @if (count($promise_details) > 0)

         @foreach($promise_details as $row)
                  @if ($row->type == 0) <!-- if type Buy promise -->
                    <div class="col-xs-12">
                          <div class="col-xs-12">
                             <h1 style="text-align: center">{{$row->title}}</h1>
                          </div>
                          <div class="col-xs-6">
                             <h2><?php echo '$'; ?>{{$row->price}}</h2>
                             <h4>Locality: {{$row->location_name}}</h4>
                             <h4>{{$row->description}}</h4>
                             <h4>TERMS & CONDITIONS:{{$row->terms}}</h4>
                          </div>
                          <div class="col-xs-6">
                             <a href="<?php echo Config::get('app.url'); ?>/promise/details/{{ $row->id }}" class="thumbnail">
                                <img width="100%" src="{!! asset('public') !!}{{$row->url}}<?php echo '/'; ?>{{$row->file_name}}" alt="...">
                             </a>
                          </div>
                          <div class="col-xs-12">
                             <div class="col-xs-12">

                                    <form style="text-align: center" method="post" action="<?php echo Config::get('app.url'); ?>/promise/buy">
                                       <input type="hidden" name="promise_id" value="{{$row->id}}">
                                       <input type="hidden" name="promise_amount" value="1">
                                       <button class="btn btn-default btn-lg">BUY NOW</button>
                                       {!! csrf_field() !!}
                                    </form>
                             </div>
                          </div>
                    </div>
                  @endif
             @if($row->type == 1) <!-- if Auction promise -->
               <div class="col-xs-12">
                   <div class="col-xs-12">
                       <h1 style="text-align: center">{{$row->title}}</h1>
                   </div>
                   <div class="col-xs-6">
                       <h2><?php echo '$'; ?>{{$row->price}}</h2>
                       <h4>Locality: {{$row->location_name}}</h4>
                       <h4>NUMBER OF WINNERS:{{$row->winners}}</h4>
                       <h4>AUCTION CLOSES:
                           <?php
                               $end_date = strtotime($row->auction_end);
                               //$end_time = $end_date - time(); //auction end time
                               //echo $end_date.'<br>';
                               // echo strtotime(time()).'<br>';
                               //echo date('Y-m-d H:i:s',$t);
                               //echo time().'<br>';
                               // echo $end_date.'<br>';
                               if(time() > $end_date){
                                   echo 'auction end';
                               } else {
                                   echo $row->auction_end;
                               }
                           ?>
                       </h4>
                       <h4>{{$row->description}}</h4>
                       <h4>TERMS & CONDITIONS:{{$row->terms}}</h4>
                   </div>
                   <div class="col-xs-6">
                       <a href="<?php echo Config::get('app.url'); ?>/promise/details/{{ $row->id }}" class="thumbnail">
                           <img width="100%" src="{!! asset('public') !!}{{$row->url}}<?php echo '/'; ?>{{$row->file_name}}" alt="...">
                       </a>
                   </div>
                   <div class="col-xs-12">
                       <div class="col-xs-12">

                           <form style="text-align: center" method="post" action="<?php echo Config::get('app.url'); ?>/promise/auction">
                               <input type="hidden" name="promise_id" value="{{$row->id}}">
                               <input type="hidden" name="promise_amount" value="1">
                               <button class="btn btn-default btn-lg">BUY NOW</button>
                               {!! csrf_field() !!}
                           </form>
                       </div>
                   </div>
               </div>
             @endif
         @endforeach
      @endif
      <?php } ?>
   </div>
@stop