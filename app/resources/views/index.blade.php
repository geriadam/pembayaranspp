<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="{{ url('plugin/owlcarousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('plugin/owlcarousel/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
</head>
<body>
    <div id="wrap">
        @include('front-include.header-scroll')
        <div id="header">
            @include('front-include.header')
        </div>
        <div class="clear"></div>
        <div class="header-middle">
            <div class="header-middle-top">
                <img src="img/header-middle-top.png">
            </div>
            <div class="clear"></div>
            <div class="owl-carousel owl-theme header-middle-background">
                <div class="header-background-item">
                    <img src="img/header-background2.jpg">
                </div>
                <div class="header-background-item">
                    <img src="img/header-background3.jpg">
                </div>
                <div class="header-background-item">
                    <img src="img/header-background4.jpg">
                </div>
                <div class="header-background-item">
                    <img src="img/header-background5.jpg">
                </div>
                <div class="header-background-item">
                    <img src="img/header-background6.jpg">
                </div>
            </div>
            <div class="clear"></div>
            <div class="header-middle-bottom">
                <img src="img/header-middle-bottom.png">
            </div>
            <div id="header-panel" class="brown">
                <div class="header-panel-title">
                    Hakiki Donarta
                </div>
                <div class="header-panel-body">
                    <p>We’ve been trusted to distribute many food products since 1969. With 49 years strong experience and market share, Hakiki Donarta becoming the leader for food distributors business.</p>
                    <div class="header-panel-footer subtitle1">
                        <div class="left">
                            <img src="img/header-panel-left.png"> 
                            <span class="text">See Our Milestone</span>
                        </div>
                        <div class="right">
                            <img src="img/header-panel-right.png"> 
                            <span class="text">See Our Distribution</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-slider">
                <div class="header-slider-container">
                    <div class="arrow-left">
                        <img src="img/arrow-left.png" width="20px" id="header-nav-left">
                    </div>
                    <div class="owl-carousel owl-theme item-slide">
                        <div class="slide hakiki">
                            <img src="img/icon/client1.png">
                        </div>
                        <div class="slide landkrone">
                            <img src="img/icon/client2.png">
                        </div>
                        <div class="slide">
                            <img src="img/icon/client3.png">
                        </div>
                        <div class="slide symrise">
                            <img src="img/icon/client4.png">
                        </div>
                        <div class="slide pakmaya">
                            <img src="img/icon/client5.png">
                        </div>
                    </div>
                    <div class="arrow-right">
                        <img src="img/arrow-right.png" width="20px" id="header-nav-right">
                    </div>
                </div>
            </div>
        </div>
        <div id="index-content">
            <div class="content-brand">
                <div class="inline-container">
                    <div class="content-brand-top">
                        <div class="one">
                            <div class="content-brand-inline-padding-one">
                                <span class="text">Find Out About</span>
                            </div>
                        </div>
                        <div class="two bodycopy1">
                            <div class="content-brand-inline-padding-two">
                                <img src="img/content1.png">
                                <span class="text">Our Brand & Principals</span>
                            </div>
                        </div>
                        <div class="two bodycopy1">
                            <div class="content-brand-inline-padding-two">
                                <img src="img/content2.png">
                                <span class="text">Facility & Technology</span>
                            </div>
                        </div>
                        <div class="two bodycopy1 end">
                            <div class="content-brand-inline-padding-two">
                                <img src="img/content3.png">
                                <span class="text">Standart & Certification</span>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="content-brand-bottom">
                        <fieldset>
                            <legend class="title title1">Our Brands</legend>
                            <div class="line-image">
                                <img src="img/brand-line-image.png" width="50%">
                            </div>
                            <div class="content-brand-inline-container">
                                <div class="left">
                                    <div class="sub-title subtitle1">Explore by Category</div>
                                    <div class="body">
                                        @foreach($product_category as $i => $val)
                                            <div class="brand-item bodycopy1" onmouseover="currentBrandIndex({{ $i }})">
                                                <a href="#">{{ $val->product_category_name }}</a>
                                                <img src="img/brand-item.png">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="right">
                                    <img src="img/content-brand.png">
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="content-news">
                <div class="inline-container">
                    <h2 class="header-line title1">News & Updates</h2>
                    <div class="owl-carousel owl-theme news-panel" id="news-panel">
                        @foreach($article as $i => $val)
                            <div class="news-panel-item">
                                <div class="news-panel-image">
                                    <img src="{{ url(App\Article::IMAGE_PATH.$val->article_featured_image) }}">
                                </div>
                                <div class="news-panel-container">
                                    <div class="news-panel-category category-{{ $val->articlecategory->article_category_color }}">
                                        {{ $val->articlecategory->article_category_name }}
                                    </div>
                                    <div class="news-panel-title">
                                        {{ $val->article_title }}
                                    </div>
                                    <div class="news-panel-description">
                                        {{ str_limit(strip_tags($val->article_short_description), 60) }}
                                    </div>
                                    <div class="news-panel-date">
                                        {{ \Carbon\Carbon::parse($val->created_at)->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="clear"></div>
                    <div class="news-panel-navigation">
                        <div class="arrow-left">
                            <img src="img/arrowleft.png" id="news-nav-left">
                        </div>
                        <div class="arrow-right">
                            <img src="img/arrowright.png" id="news-nav-right">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="container-button-view-all">
                        <a href="#" class="button-view-all">
                            <div class="button-view-all subtitle1">
                                <div class="one">
                                    <img src="img/view-all-news.png">
                                </div>
                                <div class="two">
                                    View all News
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        @include('front-include.footer')
    </div>
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('plugin/owlcarousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ url('js/js.js') }}"></script>
</body>
</html>