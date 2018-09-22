@extends('web::layouts.grids.4-4-4')

@section('title', 'Seat Discourse')
@section('page_header', 'Seat Discourse')
@section('page_description', 'About')

@section('left')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">SeAT-Discourse</h3>
    </div>
    <div class="panel-body">
      <div class="box-body">

        <legend>Thank you</legend>

        <p>Since SeAT 3.0 beta has launched SeAT Discourse has been downloaded almost 126 times. I am very content that my package is being used and supports you and your members.</p>

        <p>As you might know, <code>SeAT</code>, <code>SeAT-Groups</code> and <code>SeAT-Discourse</code> are OpenSource Projects which are available free of charge. However, programming takes up a lot of time which keeps me away from the game.</p>

        <p>If you like <code>SeAT-Discourse</code>, i highly appreciate ISK Donations to <a href="https://evewho.com/pilot/Herpaderp%20Aldent/"> {!! img('character', 95725047, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Herpaderp Aldent</a></p>

        </div>
    </div>
  </div>

@stop
@section('center')

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">About</h3>
    </div>
    <div class="panel-body">

      <legend>Bugs and issues</legend>

      <p>If you find something is not working as expected, please don't hesitate and contact me. Either use SeAT-Slack or submit an <a href="https://github.com/herpaderpaldent/seat-discourse/issues/new">issue on Github</a></p>

    </div>
  </div>

@stop
@section('right')
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-rss"></i> Update feed</h3>
    </div>
    <div class="panel-body" style="height: 500px; overflow-y: scroll">
      {!! $changelog !!}
    </div>
    <div class="panel-footer">
      <div class="row">
        <div class="col-md-6">
          Installed version: <b>{{ config('seatdiscourse.config.version') }}</b>
        </div>
        <div class="col-md-6">
          Latest version:
          <a href="https://packagist.org/packages/herpaderpaldent/seat-discourse">
            <img src="https://poser.pugx.org/herpaderpaldent/seat-discourse/v/stable" alt="SeAT Discourse version" />
          </a>
        </div>
      </div>
    </div>
  </div>
@stop
