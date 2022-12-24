
@extends("layouts.app")

@section('meta_title', $map->first_title )
@section('meta_keywords', $map->meta_keywords)
@section('meta_description', $map->meta_description)

@section('content')
<div class="page-title">
    <span>{{ $map->first_title }}</span>
</div>
<div  class="info-page">
    <div class="description">{!! $map->description !!}</div>
</div>
<div id="info01"></div>
<div id="info1">
    <div class="hr"></div>
    <div class="scholarship-full">
        @foreach ($info01 as $item)
            <div class="scholarship-full-header">
                {{ $item->title }}
            </div>
            <div id="info-text1" class="scholarship-full-text">
                {!! $item->text !!}
            </div>
        @endforeach
        <button type="button "class="scholarship-full-btn" onclick="startAnimate('#info1','#block1','#info-text1')"></button>
    </div>
</div>
<div id="info02"></div>
<div id="info2">
    <div class="hr"></div>
    <div class="scholarship-full">
        @foreach ($info02 as $item)
            <div class="scholarship-full-header">{{ $item->title }}</div>
            <div id="info-text2" class="scholarship-full-text">{!! $item->text !!}</div>
        @endforeach
        <button type="button "class="scholarship-full-btn" onclick="startAnimate('#info2','#block2','#info-text2')"></button>
    </div>
</div>
<div id="info03"></div>
<div id="info3">
    <div class="hr"></div>
    <div class="scholarship-full">
        @foreach ($info03 as $item)
            <div class="scholarship-full-header">{{ $item->title }}</div>
            <div id="info-text3" class="scholarship-full-text">{!! $item->text !!}</div>
        @endforeach
        <button type="button "class="scholarship-full-btn" onclick="startAnimate('#info3','#block3','#info-text3')"></button>
    </div>
</div>
<div class="scholarship-info">
    <div id="scholarship"></div>
    <div id="block1" class="scholarship-blok">
        @foreach ($info01 as $item)
            <div class="scholarship-title">{{ $item->title }}</div>
            <div class="scholarship-text overflow-text">
                {!! $item->description() !!}
            </div>
        @endforeach
        <div class="info-button">
            <a href="#info01"><button class="btn-details" onclick="startAnimate('#info1','#block1','#info-text1')">Детальніше</button>
        </a>
        </div>
    </div>
    <div id="block2" class="scholarship-blok">
        @foreach ($info02 as $item)
            <div class="scholarship-title">{{ $item->title }}</div>
            <div class="scholarship-text overflow-text">
                {!! $item->description() !!}
            </div>
        @endforeach
        <div class="info-button">
            <a href="#info02"><button class="btn-details" onclick="startAnimate('#info2','#block2','#info-text2')">Детальніше</button>
        </a>
        </div>
    </div>
    <div id="block3" class="scholarship-blok">
        @foreach ($info03 as $item)
            <div class="scholarship-title">{{ $item->title }}</div>
            <div class="scholarship-text overflow-text">{!! $item->description() !!}</div>
        @endforeach
        <div class="info-button">
            <a href="#info03"><button class="btn-details" onclick="startAnimate('#info3','#block3','#info-text3')">Детальніше</button>
        </a>
        </div>
    </div>
</div>

@endsection
@push('footer')

<script type="text/javascript">                     
    function startAnimate(full,short,fullText){
        let heightBlockText=0;
        let nav;
        if ($(window).width()<1000){
            heightBlockText=320;
            fullBlock= $(fullText);
        } else {      
            fullBlock = $(full);
        }
        const shortBlock=$(short);
          if(fullBlock.height() <= heightBlockText){
            animateMainBlock(shortBlock,heightBlockText);
            animateMainBlock(fullBlock,heightBlockText);
          } else {
            animateMainBlock(fullBlock,heightBlockText);
            animateMainBlock(shortBlock,heightBlockText);
          }
    };
    function animateMainBlock(block,heightBlock){  
        let animateTime=200;  
        let op;
        if ((heightBlock === '0') || (heightBlock >'320')) {
            op=0;
        } else {
            op=1;
        }
        if(block.height() <= heightBlock){
            autoHeightAnimate(block, animateTime);
        } else {
            $(window).width()<1000 ? block.css('overflow','hidden'):'';
            block.stop().animate({ height: heightBlock ,opacity: op }, animateTime);
            block.children('.info-button').children('a').children('button').attr('disabled', true);
            block.children('.scholarship-full').children('button').attr('disabled', true);
            block.children('.info-button').stop().animate({ opacity: '0'}, 300);
            block.children('.scholarship-full').children('.scholarship-full-btn').stop().animate({ opacity: '0'}, 300);
        }

    }
    function autoHeightAnimate(element, time){
        let curHeight = element.height(), 
            autoHeight = element.css('height', 'auto').height(); 
            element.height(curHeight); 
            $(window).width()<1000 ?element.css('overflow','visible'):'';
            element.stop().animate({ height: autoHeight ,opacity: '1'}, time);
            setTimeout(
                function() { 
                    element.children('.info-button').stop().animate({  opacity: '1'}, time); 
                    element.children('.scholarship-full').children('.scholarship-full-btn').stop().animate({ opacity: '1'}, time);
                } , 1500); 
            setTimeout(
                function() { 
                    element.children('.info-button').children('a').children('button').attr('disabled', false);
                    element.children('.scholarship-full').children('button').attr('disabled', false);
                } , 2000);   
    }
</script>
@endpush