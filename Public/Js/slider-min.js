(function(a){a.fn.slider=function(d){var g={auto:false,speed:500,pause:4000,style:1,width:0,hegiht:0,sliderType:"filter",btnPrevClassName:"button-slider-prev",btnNextClassName:"button-slider-next",minWidth:1000},d=a.extend(g,d),f=a(this),b=a("li",f).length,c=function(h){switch(d.sliderType){case"top":var k=-h*d.height;a("ul",f).stop(true,false).animate({top:k},d.speed);break;case"filter":a("li",f).eq(e).fadeOut(d.speed).end().eq(h).fadeIn(d.speed);break;case"left":default:var j=-h*d.width;a("ul",f).stop(true,false).animate({left:j},d.speed);break}if(d.style==2){return}a(".ec-slider-nav span",f).removeClass("current").eq(h).addClass("current")},e=0;if(d.width=="100%"){a(window).resize(function(){var h=a(window).width();if(h<d.minWidth){h=d.minWidth}f.width(h);a("ul, li",f).width(h)});d.width=a(window).width();if(d.width<d.minWidth){d.width=d.minWidth}else{d.width="100%"}}f.width(d.width);f.height(d.height);a("ul, li",f).width(d.width).height(d.height);if(b<=1){return}this.each(function(){var p=0,h,j,k=d.btnPrevClassName,o=d.btnNextClassName,s,l,n,q=function(){clearInterval(h);if(!d.auto){return}h=setInterval(function(){e=p;p+=1;if(p==(b)){p=0}c(p)},d.pause)},j='<div class="ec-slider-nav">';for(var m=0;m<b;m++){if(m==0){j+='<span class="current"></span>'}else{j+="<span></span>"}}j+="</div>";j+='<a class="'+k+'" href="javascript:;"></a>';j+='<a class="'+o+'" href="javascript:;"></a>';f.append(j);a(".ec-slider-nav span",f).mouseenter(function(){e=p;p=a(this).index();c(p)});n=a("."+k+",."+o,f);s=a("."+k,f);l=a("."+o,f);var r=function(){a(f).hover(function(){s.addClass(k+"-high");l.addClass(o+"-high")},function(){s.removeClass(k+"-high");l.removeClass(o+"-high")})};a("."+k,f).click(function(){e=p;p-=1;if(p==-1){p=b-1}c(p)});a("."+o,f).click(function(){e=p;p+=1;if(p==b){p=0}c(p)});switch(d.sliderType){case"top":a("ul",f).css("height",d.height*(b));a("ul li",f).css("float","none");break;case"filter":a("ul li",f).css({display:"none",position:"absolute"}).eq(0).show();break;case"left":default:a("ul",f).css("width",d.width*(b));break}f.hover(function(){clearInterval(h)},q);if(d.auto){q()}switch(parseInt(d.style)){case 1:n.hide();break;case 2:a(".ec-slider-nav",f).hide();r();break;default:r();break}})}})(jQuery);