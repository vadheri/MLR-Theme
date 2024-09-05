$(document).ready(function () {
    // Initialize Slick sliders
    $('.score-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1600,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 999,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    $('.news-slider').slick({
        dots: true,
        infinite: false,
        prevArrow: false,
        nextArrow: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    $('.leaders-row').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 300,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    // Menu Toggle Functionality
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.onclick = function () {
            menuToggle.classList.toggle('active');
        };
    }

    // Dropdown Toggle Functionality
    function myFunction() {
        const dropdown = document.getElementById("myDropdown");
        if (dropdown) {
            dropdown.classList.toggle("show");
        }
    }

    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    };

    // Show All Scores Functionality
    const button = document.querySelector(".see-all-scores-link");
    const matchRows = document.querySelectorAll(".match-row");

    if (button && matchRows) {
        button.addEventListener("click", function () {
            matchRows.forEach(row => {
                row.style.display = 'flex'; // or whatever your display style is for the rows
            });
            button.style.display = 'none'; // hide the button after clicking
        });
    }

    // Initial fade-in of posts on page load
    $('#posts-container').hide().fadeIn(300);

    var closeButton = document.getElementById("close-button");
    var navigation = document.getElementById("site-navigation");

    if (closeButton && navigation) {
        closeButton.addEventListener("click", function () {
            navigation.classList.remove("toggled");
            if (menuToggle) {
                menuToggle.classList.remove("active");
            }
        });
    }

    var menuItems = document.querySelectorAll(".menu-item-has-children");
    if (menuItems) {
        menuItems.forEach(function (menuItem) {
            var arrowDiv = document.createElement("div");
            arrowDiv.classList.add("arrow");
            menuItem.appendChild(arrowDiv);

            arrowDiv.addEventListener("click", function (event) {
                event.preventDefault();
                var subMenu = menuItem.querySelector(".sub-menu");

                if (menuItem.classList.contains("open")) {
                    subMenu.style.display = "none";
                    menuItem.classList.remove("open");
                } else {
                    subMenu.style.display = "block";
                    menuItem.classList.add("open");
                }
            });
        });
    }

    $('.gallery-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: false,
        dots: false,
        asNavFor: '.thumbnails-slider',
        infinite: false
    });

    $('.thumbnails-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        asNavFor: '.gallery-slider',
        dots: false,
        focusOnSelect: true,
        arrows: false,
        infinite: false
    });

    // Optional: Add custom active class to thumbnails
    $('.thumbnails-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        $('.thumbnail-item').removeClass('slick-active');
        $('.thumbnail-item').eq(nextSlide).addClass('slick-active');
    });


    $('.gallery-slider').magnificPopup({
        delegate: 'a', // target the anchor tag
        type: 'image',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            easing: 'ease-in-out',
            opener: function (openerElement) {
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


});

jQuery(document).ready(function ($) {
    var currentDate = new Date().toLocaleDateString('en-GB');
    var slides = $('.score-slider .slide');

    slides.each(function (index, slide) {
        var matchDate = $(slide).find('.match-date').text().trim();
        if (matchDate === currentDate) {
            $(slide).find('.live-text').show();
            $(slide).addClass('slick-slide slick-current slick-active');
            $('.score-slider').slick('slickUnfilter');
            $('.score-slider').slick('slickAdd', slide, 0);
        } else {
            $(slide).find('.live-text').hide();
        }
    });

    // Reinitialize the slider after modifying the DOM
    $('.score-slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
    });
});


let currentPage = 1;
$('.load-more').on('click', function () {
    currentPage++; // Increment the page number

    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
            action: 'weichie_load_more',
            paged: currentPage,
        },
        success: function (res) {
            $('.publication-list').append(res);
        }
    });
});


$(document).ready(function () {
    $('.popup-youtube').magnificPopup({
        type: 'iframe'
    });
});

$(document).ready(function ($) {
    $('#team-filter-taxonomy').on('change', function () {
        var selectedTeam = $(this).val().toLowerCase(); // Get selected team slug and convert to lowercase
        $('.match').each(function () {
            var matchTeams = $(this).data('teams').toLowerCase().split(' '); // Get the teams data attribute and convert to lowercase
            if (selectedTeam === "" || matchTeams.includes(selectedTeam)) {
                $(this).show(); // Show match if it includes the selected team
            } else {
                $(this).hide(); // Hide match otherwise
            }
        });
    });
});

$(".search-icon").click(function () {
    $(".search-container").toggleClass("full-width");
});

$(document).ready(function () {

    $(".gallery-item").mousemove(function (e) {
        zoom(e);
    });

    function zoom(e) {
        var x, y;
        var zoomer = e.currentTarget;
        if (e.offsetX) {
            offsetX = e.offsetX;
        } else {
            offsetX = e.touches[0].pageX;
        }

        if (e.offsetY) {
            offsetY = e.offsetY;
        } else {
            offsetX = e.touches[0].pageX;
        }
        x = offsetX / zoomer.offsetWidth * 100;
        y = offsetY / zoomer.offsetHeight * 100;
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }
});

$(document).ready(function($) {
    $('.specialist-group').each(function() {
        var $group = $(this);

        // Handle click on player name within the specific group
        $group.find('.member-info').on('click', function() {
            var playerId = $(this).data('player-id');

            // Remove 'active' class from all .member-info elements within this group
            $group.find('.member-info').removeClass('active');
            // Add 'active' class to the clicked .member-info within this group
            $(this).addClass('active');

            // Hide all member images within this group with a fade-out effect
            $group.find('.member-item').removeClass('active').fadeOut(400);

            // Show the corresponding member image within this group with a fade-in effect
            setTimeout(function() {
                $group.find('.member-item[data-player-id="' + playerId + '"]').addClass('active').fadeIn(400);
            }, 400);
        });
    });
});
