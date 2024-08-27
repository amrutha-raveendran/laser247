@extends('layouts.main-demo')
@section('content')
    @include('components.side_new')
    <div class="content-page">
        <div class="content">
            <div  class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 px-lg-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="marquee-box">
                                    <h4><i class="mdi mdi-microphone-outline"></i> News</h4>
                                    <marquee scrollamount="5"></marquee></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="col-xl-4">
                        <div  class="openBets">
                            <div  id="collapseSetting" class="collapse">
                                <div  style="position: relative">
                                    <div  class="stakeDiv">
                                        <h3 >stake</h3>
                                        <dl id="" class="setting-block stake-setting">
                                            <dd><input type="number" class="ng-untouched ng-pristine ng-valid"/></dd>
                                            <dd><input type="number" class="ng-untouched ng-pristine ng-valid"/></dd>
                                            <dd><input type="number" class="ng-untouched ng-pristine ng-valid"/></dd>
                                            <dd><input type="number" class="ng-untouched ng-pristine ng-valid"/></dd>
                                            <dd><input type="number" class="ng-untouched ng-pristine ng-valid"/></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <h2 >open bets</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection