<div class="meal-panel row {{ $day }}">
    <div class="col col-day">
        <div class="mlabel">{{ $day_th }}</div>
        <div class="mdate"><span id={{ $day }}></span></div>
    </div>

    @if ($userSetting->is_breakfast == 1)
        <div class="col col-meal" id="breakfast-meal-{{ $day }}" date-date="123">
            <div class="mlabel">เช้า</div>
            <div id="" class="ui-sortable ui-sortable-meal">
                @foreach ($food_logs as $food)
                    @if ($food->meal_code == 1 && $food->meal_date == $date_in_week)
                        <div class="ui-sortable ui-sortable-meal">
                            <div class="menu-body">
                                <div class="col col-food-name" 
                                    data-energy="{{$food->energy}}" 
                                    data-protein="{{$food->protein}}"
                                    data-fat="{{$food->fat}}"
                                    id="{{$food->food_id}}">
                                    {{ $food->food_thai }}
                                </div>
                                <div class="col col-delete">
                                    <a class="pull-right">
                                        <span><i class="fas fa-times"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="ui-sortable">
                    <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                        <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="right"
                    title="" data-original-title="Tooltip on left">Hello</button>
            </div>
        </div>
    @endif

    @if ($userSetting->is_morning_snack == 1)
        <div class="col col-meal" id="breakfast-snack-meal-{{ $day }}" date-date="123">
            <div class="mlabel">ว่างเช้า</div>
            <div id="" class="ui-sortable ui-sortable-meal">
                @foreach ($food_logs as $food)
                    @if ($food->meal_code == 2 && $food->meal_date == $date_in_week)
                        <div class="ui-sortable ui-sortable-meal">
                            <div class="menu-body">
                                <div class="col col-food-name" 
                                    data-energy="{{$food->energy}}" 
                                    data-protein="{{$food->protein}}"
                                    data-fat="{{$food->fat}}"
                                    id="{{$food->food_id}}">
                                    {{ $food->food_thai }}
                                </div>
                                <div class="col col-delete">
                                    <a class="pull-right">
                                        <span><i class="fas fa-times"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="ui-sortable">
                    <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                        <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($userSetting->is_lunch == 1)
        <div class="col col-meal" id="lunch-meal-{{ $day }}">
            <div class="mlabel">กลางวัน</div>
            <div id="" class="ui-sortable ui-sortable-meal">
                @foreach ($food_logs as $food)
                    @if ($food->meal_code == 3 && $food->meal_date == $date_in_week)
                        <div class="ui-sortable ui-sortable-meal">
                            <div class="menu-body">
                                <div class="col col-food-name" 
                                    data-energy="{{$food->energy}}" 
                                    data-protein="{{$food->protein}}"
                                    data-fat="{{$food->fat}}"
                                    id="{{$food->food_id}}">
                                    {{ $food->food_thai }}
                                </div>
                                <div class="col col-delete">
                                    <a class="pull-right">
                                        <span><i class="fas fa-times"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="ui-sortable">
                    <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                        <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($userSetting->is_afternoon_snack)
        <div class="col col-meal" id="lunch-snack-meal-{{ $day }}">
            <div class="mlabel">ว่างบ่าย</div>
            <div id="" class="ui-sortable ui-sortable-meal">
                @foreach ($food_logs as $food)
                    @if ($food->meal_code == 4 && $food->meal_date == $date_in_week)
                        <div class="ui-sortable ui-sortable-meal">
                            <div class="menu-body">
                                <div class="col col-food-name" 
                                    data-energy="{{$food->energy}}" 
                                    data-protein="{{$food->protein}}"
                                    data-fat="{{$food->fat}}"
                                    id="{{$food->food_id}}">
                                    {{ $food->food_thai }}
                                </div>
                                <div class="col col-delete">
                                    <a class="pull-right">
                                        <span><i class="fas fa-times"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="ui-sortable">
                    <div class="text-center menu-body ui-sortable-handle ui-sortable-placeholder ui-state-disabled">
                        <span class=""><i class="fa fa-hand-pointer-o"></i>วางที่นี่</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="col col-nutrition">
        <div class="mlabel">สารอาหาร</div>
            <div class="energy">
                <div class="nut-labels row">
                    <div class="col col-lg-3">พลังงาน</div>
                    <div class="col text-right"> 
                     <span class="current"> 0 </span>
                     <span> / </span>
                     <span class="target"> //// </span>
                     <span class="unit"> กิโลแคล </span>
                    </div>
                </div>
                <div class="nut-bars">
                    <div class="nut-bar toolow danger">น้อยเกิน</div>
                    <div class="nut-bar low warning">น้อย</div>
                    <div class="nut-bar ok">พอดี</div>
                    <div class="nut-bar high warning">มาก</div>
                    <div class="nut-bar toohigh danger">มากเกิน</div>
                </div>
            </div>
            <div class="protein">
                <div class="nut-labels row">
                    <div class="col col-lg-3">โปรตีน</div>
                    <div class="col text-right"> 
                     <span class="current"> 0 </span>
                     <span> / </span>
                     <span class="target"> 400-550 </span>
                     <span class="unit"> แกรม </span>
                    </div>
                </div>
                <div class="nut-bars">
                    <div class="nut-bar toolow danger">น้อยเกิน</div>
                    <div class="nut-bar low warning">น้อย</div>
                    <div class="nut-bar ok">พอดี</div>
                    <div class="nut-bar high warning">มาก</div>
                    <div class="nut-bar toohigh danger">มากเกิน</div>
                </div>
            </div>
            <div class="fat">
                <div class="nut-labels row">
                    <div class="col col-lg-3">ไขมัน</div>
                    <div class="col text-right"> 
                     <span class="current"> 0 </span>
                     <span> / </span>
                     <span class="target"> 400-550 </span>
                     <span class="unit"> แกรม </span>
                    </div>
                </div>
                <div class="nut-bars">
                    <div class="nut-bar toolow danger">น้อยเกิน</div>
                    <div class="nut-bar low warning">น้อย</div>
                    <div class="nut-bar ok">พอดี</div>
                    <div class="nut-bar high warning">มาก</div>
                    <div class="nut-bar toohigh danger">มากเกิน</div>
                </div>
            </div>
    </div>
</div>