if (typeof hospi == "undefined")
  var hospi = {};
if (typeof hospi.Home == "undefined")
  hospi.Home = {};

hospi.Home = {
  Init: function () {
    var thisObj = hospi.Home;
    thisObj.Events();
  },
  Events: function () {

// menu Feature Campaigns
    $(document).on({
      mouseenter: function (e) {
//stuff to do on mouse enter
        e.preventDefault();
        var _this = $(this).find("a");
        var newcontent = _this.data('href');
        if (!_this.hasClass('active')) {
          $('.featuredCampaigns ul.nav-featured li').removeClass('active');
          $('.featuredCampaigns ul.nav-featured li a.active').removeClass('active');
          $(".featuredCampaigns .nav-featured li a").css({ 'border-bottom-color': '#999' });
          _this.addClass('active');
          _this.css({ 'border-bottom-color': '#660033', 'border-top-color': '#660033' });
          if ($(this).prev()) {
            $("a", $(this).prev()).css({ 'border-bottom-color': '#660033' });
          };
          $(this).addClass('active');
        }
        if (!$(newcontent).hasClass('displayed')) {
          $('.sub-featured.displayed').removeClass('displayed');
          $(newcontent).addClass('displayed');
        }
      },
      mouseleave: function (e) {
//stuff to do on mouse leave
        e.preventDefault();
//$('.featuredCampaigns ul.nav-featured li a').removeClass('active');
      }
    }, ".featuredCampaigns ul.nav-featured li.load-child"); //pass the element as an argument to .on

  },

};

$(function () {
  var thisObj = hospi.Home;
  thisObj.Init();
});



