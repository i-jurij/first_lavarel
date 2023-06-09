<?php
$title = 'HOME';
$page_meta_description = 'GET FROM DB';
$page_meta_keywords = 'GET FROM DB';
$robots = 'INDEX, FOLLOW';
$data['content'] = 'CONTENT FOR DEL IN FUTURE';
?>

@extends('layouts/index')

@Push('css')
*{
   /* color: black; */
}
@endpush

@section('content')
<div class="">
@if (!empty($content['pages_menu']))
    @foreach ($content['pages_menu'] as $pages)
        @if (is_array($pages) && !empty($pages))
            <article class="main_section_article ">
                <a class="main_section_article_content_a" href="{{url('/'.$pages['alias'])}}" >
                    <div class="main_section_article_imgdiv">
                    <img src="{{asset('storage/'.$pages['img'])}}" alt="{{$pages['title']}}" class="main_section_article_imgdiv_img" />
                    </div>

                    <div class="main_section_article_content margin_top_1rem">
                        <h2>{{mb_ucfirst($pages['title'])}}</h2>
                        <span>
                            {{mb_ucfirst($pages['description'])}}
                        </span>
                    </div>
                </a>
			</article>
        @else
            There are no pages in the database
        @endif
    @endforeach
@else
    No routes (pages)
@endif
</div>
@stop

@Push('js')
<script></script>
@endpush
