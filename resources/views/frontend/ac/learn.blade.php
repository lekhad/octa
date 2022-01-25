@extends('frontend.layouts.app')

@section('title', app_name() . ' | Library' )

@section('content')


    {{-- Content of the day --}}
	@if($cotd)
	<div id="cotd" class="flexslider ac-slider" style="overflow-y: hidden;">
		<ul class="slides">
			<li class="progression_studios_animate_left">
				<div class="ac-slider-image-background" style="background-image:url('{{ config('ac.CDN_MEDIA') . $cotd->getImage(true) }}');">
					<div class="ac-slider-display-table">
						<div class="ac-slider-vertical-align">
							
							<div class="container">
								
								<div class="ac-slider-caption-width">
									<div class="ac-slider-caption-align">
										<h1 style="font-size: 1.8em;">Content of the day</h1>    
										<h2 style="font-size: 2em;">
											<a href="{{ route('frontend.content', ['slug' => $cotd->slug]) }}">
												@if(!empty($cotd->title_cotd))
													{!! \Illuminate\Support\Str::limit($cotd->title_cotd, 55,'...') !!}
												@else
													{!! \Illuminate\Support\Str::limit($cotd->title, 55,'...') !!}
												@endif
											</a>
										</h2>
										@if($cotd->contentable->mentor)
											<p style="margin-top: -24px;">By: <strong>{{ $cotd->getContributor() }}</strong>@if(isset($cotd->contentable->length)) &nbsp;&nbsp;|&nbsp;&nbsp;Duration: {{ durationHumanize($cotd->contentable->length) }}@endif</p>
										@endif
										<ul class="slider-video-post-meta-list" style="margin-top: -12px;">
											{{--<li class="slider-video-post-meta-cat"><ul><li>Duration: {{ durationHumanize($cotd->contentable->length) }}</li></ul></li>--}}
											{{--<li class="slider-video-post-meta-reviews">
												
												<div class="average-rating-video-post">
													<div class="average-rating-video-empty">
														<span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span>
													</div>
													<div class="average-rating-overflow-width" style="width:80%;">
														<div class="average-rating-video-filled">
															<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>
															<div class="clearfix"></div>
														</div><!-- close .average-rating-video-filled -->
													</div><!-- close .average-rating-overflow-width -->
												</div><!-- close .average-rating-video-post -->
												
												<div class="clearfix"></div>
											</li>--}}
											{{--<li class="slider-video-post-meta-year">{{ $cotd->contentable->releaseDate }}</li>--}}
										</ul>
										<div class="clearfix"></div>
											@if($cotd->tags)
												<ul class="slider-video-post-meta-list">
													@foreach($cotd->tags as $tag)
														@if($tag->title != "Animation review")
															<li class="slider-video-post-meta-rating"><span><a href="{{ route('frontend.tag', urlencode($tag->title)) }}">{{ $tag->title }}</a></span></li>
														@endif
													@endforeach
												</ul>
											@endif
										<div class="clearfix"></div>
										<div class="ac-slider-excerpt">
											@if(!empty($cotd->description_cotd))
												{!! \Illuminate\Support\Str::words($cotd->description_cotd, 50,'...') !!}
											@else
												{!! \Illuminate\Support\Str::words($cotd->description, 50,'...') !!}
											@endif
										</div>
										@if($cotd->contentable_type == "MorphReview")
											<a class="btn btn-slider-pro" href="{{ $cotd->contentable->syncsketch }}" target="_blank" style="margin-right: 8px;"><img src="{{ config('ac.CDN_MEDIA') }}{{ 'img/frontend/syncsketch.png' }}" style="display: initial; max-width: 24px; vertical-align: middle; padding-top: 0px; margin-right: 8px;">SyncSketch</a>
											<a class="btn btn-slider-pro" href="{{ route('frontend.content', ['slug' => $cotd->slug]) }}"><i class="fas fa-play-circle" style="font-size: 24px; vertical-align: sub;"></i>Watch</a>
										@elseif($cotd->contentable_type == "MorphAsset")
											<a class="btn btn-slider-pro" href="{{ route('frontend.assets') }}" target="_blank" style="margin-right: 8px;"><i class="fas fa-download" style="font-size: 24px; vertical-align: sub;"></i>&nbsp;Download</a>
										@elseif($cotd->contentable_type == "MorphVideo")
											<a class="btn btn-slider-pro" href="{{ route('frontend.content', ['slug' => $cotd->slug]) }}"><i class="fas fa-play-circle" style="font-size: 24px; vertical-align: sub;"></i>Watch</a>
										@endif
										
									</div><!-- close .ac-slider-caption-align -->
								</div><!-- close .ac-slider-caption-width -->
								
							</div><!-- close .container -->
							
						</div><!-- close .ac-slider-vertical-align -->
					</div><!-- close .ac-slider-display-table -->
					
					<div class="ac-slider-overlay-gradient"></div>
					
					{{--<div class="ac-skrn-slider-upside-down" style="background-image:url(https://via.placeholder.com/1700x1133);"></div>--}}
					
					
				</div><!-- close .ac-slider-image-background -->
			</li>
		</ul>
	</div><!-- close .ac-slider - See /js/script.js file for options -->
	@endif

	{{-- Last content --}}
	@if(count($lastcontents))
	<div id="content-pro">
		
		<div class="container custom-gutters-pro">
			
			<div style="height:15px;"></div>
			
			<h2 class="post-list-heading">Latest library addition<span>We are uploading new quality content daily</span></h2>
			

			<div class="ac-elementor-carousel-container ac-always-arrows-on">
				<div id="progression-video-carousel" class="owl-carousel progression-carousel-theme allprogression-video-carousel">
					
				
					@foreach ($lastcontents as $lastcontent)
						@render('frontend.includes.videoitem', [ 'content' => $lastcontent, 'show_category' => true ])
					@endforeach

				</div><!-- close #progression-video-carousel - See /js/script.js file for options -->
			</div><!-- close .ac-elementor-carousel-container  -->

			<div class="clearfix"></div>
							
		</div><!-- close .container -->

	</div><!-- close #content-pro -->
	@endif

	
    {{-- Categories --}}
    @foreach($categories as $category)
	@if(count($category->contents))
    <div id="content-pro" style="padding: 0px;">
		<div class="container custom-gutters-pro">
			<h2 class="post-list-heading"><a href="{{ route('frontend.category', $category->title) }}">{{ $category->title }} <i class="fas fa-external-link-alt" style="vertical-align: super; font-size: 12px; color: #22b2ee;"></i></a></h2>
			<div class="ac-elementor-carousel-container ac-always-arrows-on">
				<div id="progression-video-carousel" class="owl-carousel progression-carousel-theme allprogression-video-carousel">
                
					@foreach($category->contents as $content)
						@render('frontend.includes.videoitem', [ 'content' => $content ])
					@endforeach
					
				</div><!-- close #progression-video-carousel - See /js/script.js file for options -->
			</div><!-- close .ac-elementor-carousel-container  -->

			<div class="clearfix"></div>
							
		</div><!-- close .container -->

    </div><!-- close #content-pro -->
	@endif
    @endforeach


	{{-- UP --}}
    <a href="#0" id="pro-scroll-top"><i class="fas fa-chevron-up"></i></a>

@endsection


@push('after-scripts')

<script>
	$( document ).ready(function() {

		// A LA YOUTUBE replace img with muted version of video on hover... not working on mobile obviously
		$( ".replaceImgVid" ).hover(
			function() {
				var hv = $(this).find('video:first');
				if(hv.length) {
					hv[0].load();
					hv[0].play();
					$(".replaceImgVid").find('video:first').bind("playing", function() {
						$(this).parent().find('img:first').css("display", "none");
						$(this).css("display", "");
						
					});
				}
			}, function() {
				var hv = $(this).find('video:first');
				if(hv.length) {
					$(this).find('img:first').css("display", "");
					hv.css("display", "none");
					hv[0].pause();
				}
			}
        );
	});
	
</script>
@endpush