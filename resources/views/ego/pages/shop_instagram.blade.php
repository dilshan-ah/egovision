@extends('layouts.ego-app')
@section('content')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<!-- CSS links-->
<!-- fancybox -->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.css'>
<!-- magnific-popup -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
<link rel="stylesheet" href="{{asset('ego/shop_instagram.css')}}">
<section class="portfolio-section" id="portfolio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Shop Instagram</h2>
                <p class="text-light">Welcome to Ego Vision world! <br>
                    Discover the eyes looks with our vibrant shades and see how the lenses could appear on you! Tag @desioeyes for a chance to be featured</p>
            </div>
        </div>
        <div class="portfolio-menu mt-2 mb-4">
            <nav class="controls">
                <button type="button" class="control outline  p-4" data-filter="all">All Shades </button>
                <button type="button" class="control outline  p-4" data-filter=".web">Brown Lenses</button>
                <button type="button" class="control outline  p-4" data-filter=".dev">Grey Lenses</button>
                <button type="button" class="control outline  p-4" data-filter=".wp">Green Lenses</button>
            </nav>
        </div>
        <ul class="row portfolio-item">
            <li class="mix dev col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18065316847608153_1.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18065316847608153_1.jpg">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix web col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18065316847608153_1.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18065316847608153_1.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix wp col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18126076765355790_2.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18126076765355790_2.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix dev col-xl-3 col-md-4 col-12 col-sm-6 pd ">
                <img src="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17880316784521362_1.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=720&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17880316784521362_1.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix web col-xl-3 col-md-4 col-12 col-sm-6 pd ">
                <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17906455478315431_0.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17906455478315431_0.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix wp col-xl-3 col-md-4 col-12 col-sm-6 pd ">
                <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17930031653044148_0.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F17930031653044148_0.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix dev col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18022937879157703_0.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://m.photoslurp.com/i/fit?width=576&height=720&url=https%3A%2F%2Fpslurpmedia.s3.amazonaws.com%2Finstagram-business%2F18022937879157703_0.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix web col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://www.desiolens.com/media/wysiwyg/Innocent_white_desio_lenses_square.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://www.desiolens.com/media/wysiwyg/Innocent_white_desio_lenses_square.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix wp col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://www.desiolens.com/media/wysiwyg/wild_Green_desio_lenses_square.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://www.desiolens.com/media/wysiwyg/wild_Green_desio_lenses_square.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix dev col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://www.desiolens.com/media/wysiwyg/Cappucino_desio_lenses_square.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://www.desiolens.com/media/wysiwyg/Cappucino_desio_lenses_square.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix web col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://www.desiolens.com/media/wysiwyg/Sublime_grey_desio_lenses_square.jpeg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://www.desiolens.com/media/wysiwyg/Sublime_grey_desio_lenses_square.jpeg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
            <li class="mix wp col-xl-3 col-md-4 col-12 col-sm-6 pd">
                <img src="https://www.desiolens.com/media/wysiwyg/Deep_Brown_desio_colored_contact_lenses_1.jpg" itemprop="thumbnail" alt="Image description" />
                <div class="portfolio-overlay">
                    <div class="overlay-content">
                        <p class="category">Model Name</p>
                        <a href="#" title="View Project" target="_blank">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-link" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                        <a data-fancybox="item" title="click to zoom-in" href="https://www.desiolens.com/media/wysiwyg/Deep_Brown_desio_colored_contact_lenses_1.jpg" data-size="1200x600">
                            <div class="magnify-icon">
                                <p><span><i class="fa fa-search" aria-hidden="true"></i></span></p>
                            </div>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- JS Links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<!-- Mixitup -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.2.2/mixitup.min.js'></script>
<!-- fancybox -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js'></script>
<!-- Fancybox js -->
<script>
    /*Downloaded from https://www.codeseek.co/ezra_siton/mixitup-fancybox3-JydYqm */
    // 1. querySelector
    var containerEl = document.querySelector(".portfolio-item");
    // 2. Passing the configuration object inline
    //https://www.kunkalabs.com/mixitup/docs/configuration-object/
    var mixer = mixitup(containerEl, {
        animation: {
            effects: "fade translateZ(-100px)",
            effectsIn: "fade translateY(-100%)",
            easing: "cubic-bezier(0.645, 0.045, 0.355, 1)"
        }
    });
    // fancybox insilaze & options //
    $("[data-fancybox]").fancybox({
        loop: true,
        hash: true,
        transitionEffect: "slide",
        /* zoom VS next////////////////////
        clickContent - i modify the deafult - now when you click on the image you go to the next image - i more like this approach than zoom on desktop (This idea was in the classic/first lightbox) */
        clickContent: function(current, event) {
            return current.type === "image" ? "next" : false;
        }
    });
</script>
@endsection
