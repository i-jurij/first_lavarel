@php
$title = "Shedule of masters";
$page_meta_description = "Shedule of masters";
$page_meta_keywords = "Shedule of masters";
$robots = "NOINDEX, NOFOLLOW";
@endphp
@extends("layouts/index_admin")

@section("content")
<link rel="stylesheet" href="{{ url()->asset('storage'.DIRECTORY_SEPARATOR.'ppntmt'.DIRECTORY_SEPARATOR.'appointment'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'style.css') }}" />

    @if (!empty($data['res']))
        <div class="content">
            @if (is_array($data['res']))
                @php
                    print_r($data['res'])
                @endphp
            @elseif (is_string($data['res']))
                <p>{{$data['res']}}</p>
            @endif
        </div>
    @else
    <div class="content">
    <p class="" id="p_pro">Показать / скрыть справку</p>
    <div class="display_none text_left margintb1" style="max-width:60rem;" id="pro">
        <p>Запланированные выходные дни или часы в графике отмечены цветом.</p>
        <p>Чтобы добавить <b>выходной день</b>:</p>
        <ul>
            <li>нажмите на дату.</li>
        </ul>
        <p>Чтобы добавить <b>отдельное время отдыха или перерыва:</b></p>
        <ul>
            <li>нажмите на ячейку на пересечении нужного дня и времени.</li>
        </ul>
        <p>Выходные отмечать не нужно, по умолчанию они отключены для записи клиентов.</p>
        <p>Нажмите кнопку Готово, чтобы сохранить изменения.</p>
    </div>
    </div>
    <form action="{{url()->route('admin.masters.shedule.edit')}}" method="post" id="zapis_usluga_form" class="content pad form_radio_btn">
    @csrf
        <div id="master_choice">
            @foreach ($data['masters'] as $master)
                <label class="">
                    <input
                        type="radio"
                        name="master"
                        id="{{$master['id']}}"
                        value="{{$master['id']}}"
                    />
                    <span>
                        <img
                            class="display_inline_block margint0b0rlauto"
                            src="{{asset('storage'.DIRECTORY_SEPARATOR.$master['master_photo'])}}"
                            alt="Photo of {{$master['master_name']}} {{$master['sec_name']}} {{$master['master_fam']}}"
                            style="max-width:120px;"
                        />
                        <p>
                            {{$master['master_name']}} {{$master['sec_name']}} {{$master['master_fam']}}<br />{{$master['master_phone_number']}}
                        </p>
                    </span>
                </label>
            @endforeach
        </div>
        <div id="time_choice"></div>
        <div class="hor_center buts display_none" id="buttons_div">
            <button type="button" class="but" id="zapis_usluga_form_res" disabled />Сбросить</button>
            <button type="button" class="but" id="zapis_usluga_form_sub" disabled />Готово</button>
        </div>
    </form>

    @endif
</div>
<script src="{{ url()->asset('storage'.DIRECTORY_SEPARATOR.'ppntmt'.DIRECTORY_SEPARATOR.'appointment'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'appointment.js')}}"></script>

<script >
    document.addEventListener('DOMContentLoaded', function () {
        //submit master form
        document.querySelector('#master_choice').addEventListener('click',function(element){
            //document.querySelector('form#grafiki-master').submit();

            let input = document.querySelector('input[type="radio"][name="master"]:checked');
            if(!!input) {
               var master_id = input.value;
               var service_id = '';

                document.querySelector('#master_choice').style.display = 'none';

                if (master_id !== 'undefined' || master_id !== '' || master_id !== null) {
                    document.querySelector('#buttons_div').style.display = 'block';
                    appointment('schedule', "{{url()->route('admin.masters.shedule.edit')}}", service_id, master_id, "{{csrf_token()}}");
                    //window.scrollTo(0, 0);
                }
            }
        });
    }, false);
</script>
@stop
