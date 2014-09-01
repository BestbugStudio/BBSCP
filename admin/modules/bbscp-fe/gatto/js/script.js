$(document).ready(

    function () {
        $('#attr1').showDown(1000);

        $('#showPortfolio').click(function(){
            $('#changefix').hideUp(1000);
            $('#portfolio').delay(1000).showDown(1000)
        });
        $('#showChangefix').click(function(){
            $('#portfolio').hideUp(1000);
            $('#changefix').delay(1000).showDown(1000)
        });

        $('#showLavori').click(function(){
            $('#scuola').hideUp(1000);
            $('#lavori').delay(1000).showDown(1000)
        });
        $('#showScuola').click(function(){
            $('#lavori').hideUp(1000);
            $('#scuola').delay(1000).showDown(1000)
        });

        var $element = '#attr';
        var $MAX_ELE = 4;
        var $i=1;
        var $actualEle="";
        var $nextEle="";
        setInterval(function () {
            if ($i==$MAX_ELE){
                $($('#attr4')).fadeOut(1000);
                $i=1;
                $nextEle =$($element+$i);
                $nextEle.delay(1000).fadeIn(1000);
            }else{
                $actualEle = $($element + $i);
                $nextEle =$($element+($i+1));
                $i = $i +1;
                $actualEle.fadeOut(1000);
                $nextEle.delay(1000).fadeIn(1000);
            }
        }, 5000);

        
    }
);

//WIP

(function ($) {
  var getUnqueuedOpts = function (opts) {
    return {
      queue: false,
      duration: opts.duration,
      easing: opts.easing
    };
  };
  $.fn.showDown = function (opts) {
    opts = opts || {};
    $(this).hide().slideDown(opts).animate({ opacity: 1 }, getUnqueuedOpts(opts));
  };
  $.fn.hideUp = function (opts) {
    opts = opts || {};
    $(this).show().slideUp(opts).animate({ opacity: 0 }, getUnqueuedOpts(opts));
  };
  $.fn.verticalFade = function (opts) {
    opts = opts || {};
    if ($(this).is(':visible')) {
      $(this).hideUp(opts);
    } else {
      $(this).showDown(opts);
    }
  };
}(jQuery));