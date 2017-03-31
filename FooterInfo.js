

    $(window).scroll(function() {
    
            if($(window).scrollTop() < 300) { //scrolled past the other div?
                $("#containerFooter").fadeIn(200); //reached the desired point -- show div
            }
            else if($(window).scrollTop() > 300) { //scrolled past the other div?
                $("#containerFooter").fadeOut(200); //reached the desired point -- show div
            }
    });