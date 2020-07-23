(function($) {
  
  "use strict";


    //  ==================== SCROLLING FUNCTION ====================

    $(window).on("scroll", function() {
        var scroll = $(window).scrollTop();
        if (scroll > 30) {
            $(".top_bar").addClass("scroll animated slideInDown");
        } else if (scroll < 30) {
            $(".top_bar").removeClass("scroll animated slideInDown")
        }
    });



    var header_height = $(".top_bar").innerHeight();


  $("#videolist").on("click", function(){
      $(".videolist_menu").toggleClass("active");
      return false;
    });

    $(".cloesList").on("click", function() {
        $(".videolist_menu").removeClass("active");
    });

     $(".videolist_menu").on("click", function(e){
        e.stopPropagation();
    });
    


    $(".side_menu").css({
        "top": header_height
    });



    $(".menu").on("click", function(){
      $(".side_menu").toggleClass("active");
      return false;
    });

  

    $("html").on("click", function() {
        $(".side_menu").removeClass("active");
    });
    $(".menu, .side_menu").on("click", function(e){
        e.stopPropagation();
    });


   
 
        $(".user-log").on("click", function () {
            if (window.islogin) {
            $(".account-menu").slideToggle();
            }
        });
        $("html").on("click", function () {
             if (window.islogin) {
            $(".account-menu").slideUp();
            }
        });
 
        $(".user-log").on("click", function () {
             if (!window.islogin) {
            window.location.href = "./login.html"
            }
        });
    





    $(".user-log, .account-menu").on("click", function(e) {
        e.stopPropagation();
    });


    //  ==================== SCROLLING FUNCTION ====================
    
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })




})(window.jQuery);


