@extends('frontend.template')

@section('title', 'Portfolio')

@section('page_level_plugins_css')
    <link href="{{ url('/') }}/assets/global/plugins/cubeportfolio/css/cubeportfolio.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
    <link href="{{ url('/') }}/assets/corporate/css/portfolio.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="{{ url('/') }}/assets/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>

    <script src="{{ url('/') }}/assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/corporate/scripts/portfolio.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
        });
    </script>
@endsection

@section('content')
<div class="main">
    <div class="container">
        <h1>Our Work</h1>
        <div class="page-content-inner">
            <div class="portfolio-content portfolio-1">
                <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                    <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn red btn-outline uppercase"> All
                        <div class="cbp-filter-counter"></div>
                    </div>
                    @foreach($categories as $category)
                        <div data-filter=".{{ $category->slug }}" class="cbp-filter-item btn red btn-outline uppercase"> {{ $category->name }}
                            <div class="cbp-filter-counter"></div>
                        </div>
                    @endforeach
                </div>
                <div id="js-grid-juicy-projects" class="cbp">
                    @foreach($portfolios as $portfolio)
                        <div class="cbp-item {{ $portfolio->category_slugs }}">
                            <div class="cbp-caption">
                                <div class="cbp-caption-defaultWrap">
                                    <img src="{{ $portfolio->featured_image_thumbnail }}" alt=""> </div>
                                <div class="cbp-caption-activeWrap">
                                    <div class="cbp-l-caption-alignCenter">
                                        <div class="cbp-l-caption-body">
                                            <a href="portfolio/<?php echo  $portfolio->id; ?>" class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" rel="nofollow">more info</a>
                                            <a href="{{ $portfolio->featured_image_url }}" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="{{ $portfolio->title }}">view larger</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center">{{ $portfolio->title }}</div>
                            <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">{{ $portfolio->overview }}</div>
                        </div>
                    @endforeach
                </div>
                <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                    <a href="{{ url('/api/portfolio/loadmore') }}" class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                        <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                        <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                        <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
