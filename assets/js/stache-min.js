!function(){function e(e){return document.getElementById(e)}function n(){function n(){r+=1;var e=(100/l*r<<0)+"%";if(s.style.width=e,a.innerHTML="Loading "+e,r===l)return o()}function o(){t.style.opacity=0,setTimeout(function(){t.style.display="none"},1200)}var t=e("loader"),s=e("progress"),a=e("progstat"),i=document.images,r=0,l=i.length;if(0==l)return o();for(var d=0;d<l;d++){var c=new Image;c.onload=n,c.onerror=n,c.src=i[d].src}}document.addEventListener("DOMContentLoaded",n,!1)}(jQuery),function($){var e=$(document),n=$("#masthead"),o="scrolled";e.scroll(function(){n.toggleClass("scrolled",e.scrollTop()>=10)})}(jQuery),jQuery(window).on("orientationchange",function($){0==window.orientation?($("#turnme").removeClass("show"),$("body").removeClass("disablescroll")):($("#turnme").addClass("show"),$("body").addClass("disablescroll"))}),function($){$(".brandicons").slick({infinite:!0,slidesToShow:8,speed:300,dots:!1,arrows:!1,slidesToScroll:1,autoplay:!0,autoplaySpeed:3e3,responsive:[{breakpoint:1024,settings:{slidesToShow:8,slidesToScroll:8,infinite:!0,dots:!0}},{breakpoint:600,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:480,settings:{unslick:!0}}]})}(jQuery),function($){var e=$(".grid").imagesLoaded(function(){e.masonry({columnWidth:".grid-sizer",itemSelector:".grid-item",gutter:2,percentPosition:!0})})}(jQuery),function($){function e(e){var t=e.find(".marker"),s={zoom:13,center:new google.maps.LatLng(0,0),mapTypeId:google.maps.MapTypeId.ROADMAP},a=new google.maps.Map(e[0],s);return a.markers=[],t.each(function(){n($(this),a)}),o(a),a}function n(e,n){var o=new google.maps.LatLng(e.attr("data-lat"),e.attr("data-lng")),t={url:e.attr("data-icon"),size:new google.maps.Size(64,64),scaledSize:new google.maps.Size(64,64)},s=new google.maps.Marker({position:o,map:n,icon:t});if(n.markers.push(s),e.html()){var a=new google.maps.InfoWindow({content:e.html()});google.maps.event.addListener(s,"click",function(){a.open(n,s)})}}function o(e){var n=new google.maps.LatLngBounds;$.each(e.markers,function(e,o){var t=new google.maps.LatLng(o.position.lat(),o.position.lng());n.extend(t)}),1==e.markers.length?(e.setCenter(n.getCenter()),e.setZoom(13)):e.fitBounds(n)}var t=null;$(document).ready(function(){$("#map").each(function(){t=e($(this))})})}(jQuery);