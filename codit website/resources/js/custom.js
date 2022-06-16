import {
    URL
} from "url";

$(function () {
    'use strict';
    //Editing footer Bg
    var fBG = $("#end").css('background-color');
    $('footer').css('background-color', fBG);

    //Last work filters
    (function () {
        var Allcatiguries = $("#filter a");
        var showAll = $("#all");
        for (var i = 0; i < Allcatiguries.length; i++) {
            $(Allcatiguries[i]).on('click', function (e) {
                var getId = e.target.id;
                $(Allcatiguries).removeClass('current');
                $(this).addClass('current');
                var m = '.';
                m += getId;
                var getCurrent = $(m);
                if (getId === 'all') {
                    $('.post').fadeIn();
                } else {
                    $('.post').fadeOut(1);
                    $(getCurrent).fadeIn();
                }
            });
        }
    })();

    //smooth scrolling with animate
    $("#filter a").on("click", function () {
        $("html,body").animate({
            scrollTop: $("#filter").offset().top
        }, 1000);
    });

    //get select position of input or area
    function getInputSelection(el) {
        el.focus();
        var start = 0,
            end = 0,
            normalizedValue, range,
            textInputRange, len, endRange;

        if (typeof el.selectionStart == "number" && typeof el.selectionEnd == "number") {
            start = el.selectionStart;
            end = el.selectionEnd;
        } else {
            range = document.selection.createRange();

            if (range && range.parentElement() == el) {
                len = el.value.length;
                normalizedValue = el.value.replace(/\r\n/g, "\n");

                // Create a working TextRange that lives only in the input
                textInputRange = el.createTextRange();
                textInputRange.moveToBookmark(range.getBookmark());

                // Check if the start and end of the selection are at the very end
                // of the input, since moveStart/moveEnd doesn't return what we want
                // in those cases
                endRange = el.createTextRange();
                endRange.collapse(false);

                if (textInputRange.compareEndPoints("StartToEnd", endRange) > -1) {
                    start = end = len;
                } else {
                    start = -textInputRange.moveStart("character", -len);
                    start += normalizedValue.slice(0, start).split("\n").length - 1;

                    if (textInputRange.compareEndPoints("EndToEnd", endRange) > -1) {
                        end = len;
                    } else {
                        end = -textInputRange.moveEnd("character", -len);
                        end += normalizedValue.slice(0, end).split("\n").length - 1;
                    }
                }
            }
        }
        return {
            start: start,
            end: end
        };
    }

    //chat emoji codes
    $(".emoji_toggle").on("click", function () {
        $(".chat_footer .emoji_toggle,.card .emoji_toggle").toggleClass('color_orange');
        $('.emoji_btn').empty();
        for (var i = 128512; i < 128577; i++) {
            $('.emoji_btn').append('<button>&#' + i + ';</button>');
        }
        $('.emoji').slideToggle();
        $(".emoji_tab span").removeClass('active');
        $(".emoji_tab span").first().addClass('active');
    });
    $(".emoji_tab span").on("click", function () {
        $(".emoji_tab span").removeClass('active');
        var i;
        $(this).addClass('active');
        if ($(this).attr('data-for') == '1') {
            $('.emoji_btn').empty();
            for (i = 128512; i < 128577; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '2') {
            $('.emoji_btn').empty();
            for (i = 127744; i < 127777; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
            for (i = 127792; i < 127820; i++) {
                if (i != 127798)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '3') {
            $('.emoji_btn').empty();
            for (i = 128581; i < 128591; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
            for (i = 127820; i < 127869; i++) {
                if (i != 127798)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '4') {
            $('.emoji_btn').empty();
            for (i = 128000; i < 128062; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '5') {
            $('.emoji_btn').empty();
            for (i = 128130; i < 128189; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
            for (i = 128190; i < 128190; i++) {
                if (i != 128248)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '6') {
            $('.emoji_btn').empty();
            for (i = 128066; i < 128130; i++) {
                $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '7') {
            $('.emoji_btn').empty();
            for (i = 127872; i < 127892; i++) {
                if (i != 127892)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
            for (i = 127904; i < 127946; i++) {
                if (i != 127941)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        } else if ($(this).attr('data-for') == '8') {
            $('.emoji_btn').empty();
            for (i = 128190; i < 128253; i++) {
                if (i != 128248)
                    $('.emoji_btn').append('<button>&#' + i + ';</button>');
            }
        }
    });
    $(".emoji_btn").on("click", "button", function () {

            var input = $('.chat_footer input,.card-footer input'),
                char=$(this).text(),
				selection = getInputSelection(input[0]);

			if (selection.start == selection.end) {
				//No text selected
				if(selection.start == 0){
					$(input).val(char + $(input).val());
				}
				else if(selection.start == $(input).val().length)
				{
					$(input).val($(input).val()+char);
				}
				else {
					$(input).val(($(input).val()).substring(0, selection.start)+char+($(input).val()).substring(selection.start, $(input).val().length));
				}
			} else {
				//You've selected text ("+result.start+" to "+ result.end +") from a total length of " + inputContent
				if(selection.start==0 && selection.end ==1)
				$(input).val(char);
				else
				$(input).val(($(input).val()).substring(0, selection.start)+char+($(input).val()).substring(selection.end, $(input).val().length));
			}
    });

    //manage flags
        var short='../../flags/'+$('select[name="country"] option[value="'+$('select[name="country"]').val()+'"]').attr('data-flag')+'.png';
            $('select[name="country"]').css({
                'backgroundImage':'url("'+short+'")',
                'backgroundRepeat':'no-repeat',
                'backgroundSize':'25px',
                'backgroundPosition':'center left',
                'paddingLeft':'25px',
            });
        $('div').on('change','select[name="country"]',function(){
            short='../../flags/'+$('select[name="country"] option[value="'+$(this).val()+'"]').attr('data-flag')+'.png';
            $('select[name="country"]').css({
            'backgroundImage':'url("'+short+'")',
            });
        });

    //personalPic script
    $('#personalPic').on('change', function () {
        if ($('#personalPic').val()) {
            $('#personalPic~a').show();
        } else {
            $('#personalPic~a').hide();
        }
    });

    $('#personalPic~a.btn-danger').on('click', function () {
        $('#personalPic').val('');
        $('#personalPic~a').hide();
    });

    /*
    //Last work Up or Down
    (function () {
        var Allrates = $("#rate .btn_orange");
        for (var i = 0; i < Allrates.length; i++) {
            $(Allrates[i]).on('click', function (e) {
                //var getId=e.target.id;
                var rateId = $(this).attr("post_no");
                if ($(this).hasClass("chose")) {
                    //delete rate
                    $("button.btn_orange[post_no='" + rateId + "']").removeClass('chose');
                } else {
                    //add rate up or down
                    $("button.btn_orange[post_no='" + rateId + "']").removeClass('chose');
                    $(this).addClass('chose');
                }
            });
        }
    })();
    */

    //chat theme
    $('.chat_btn').on('click', function () {
        $('.banel').toggleClass('open');
        $(this).toggleClass('open');
    });

    //Ajax loading
    $('#loading').bind('ajaxStart', function () {
            $(this).show();
        })
        .bind('ajaxComplete', function () {
            $(this).hide();
        });

    //Format cards in window
    $(window).on('resize', function (e) {
        var cardWidth = $(".offer .card").css('width');
        //console.log(cardWidth);
        if (cardWidth < '220px') {
            $(".offer .card .price").addClass('sm');
        } else {
            $(".offer .card .price").removeClass('sm');
        }
    });

    $('.offer .card').on({
        mouseenter: function () {
            $('.offer .card:not(:hover)').addClass('focus');
            $(this).removeClass('focus');
        },
        mouseleave: function () {
            $('.offer .card:not(:hover)').removeClass('focus');
            $(this).removeClass('focus');
        }
    });

});
window.onload = function () {
    'use strict';
    $("#loading").remove();
}
