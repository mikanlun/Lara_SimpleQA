$(function(){

    /**
     * ウィンドウ上端でグローバルナビゲーションを固定する
     */
    $(window).on('scroll', function(){
        var scrollValue = $(this).scrollTop();
        $('.fixedmenu')
        .trigger('customScroll', {posY: scrollValue});
    });

    $('.fixedmenu')
    .each(function(){
        var $this = $(this);
        $this.data('initial', $this.offset().top);
    })
    .on('customScroll', function(event, object){

        var $this = $(this);

        if($this.data('initial') <= object.posY) {
            //要素を固定
            if(!$this.hasClass('fixed')) {
                var $substitute = $('<div></div>');
                $substitute
                .css({
                    'margin':'0',
                    'padding':'0',
                    'font-size':'0',
                    'height':'0'
                })
                .addClass('substitute')
                .height($this.outerHeight(true))
                .width($this.outerWidth(true));

                $this
                .after($substitute)
                .addClass('fixed')
                .css({top: 0});
            }
        } else {
            //要素の固定を解除
            $this.next('.substitute').remove();
            $this.removeClass('fixed');
        }
    });


    /**
     * スクロールしてページトップに戻る
     */
    var topBtn = $('#page-top');
    topBtn.hide();
    //スクロールが100に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });


    /**
     * 質問削除
     */
    $('.delete_question').on('click', function(){
        var $this = $(this);
        var id = 'delete_question_submit_' + $this.data('id');
        if(window.confirm('質問を削除しますがよろしいですか？')) {
            document.getElementById(id).submit();
        } else {
            return false;
        }
    });

    /**
     * 回答削除
     */
    $('.delete_answer').on('click', function(){
        var $this = $(this);
        var id = 'delete_answer_submit_' + $this.data('id');
        if(window.confirm('回答を削除しますがよろしいですか？')) {
            document.getElementById(id).submit();
        } else {
            return false;
        }
    });

    /**
     * アカウント削除
     */
    $('#delete_account').on('click', function(){
        var $this = $(this);
        var userName;
        var msg;
        userName = $this.data('user_name');
        msg = userName + ' 様、アカウントを削除しますがよろしいですか？';
        if(window.confirm(msg)) {
            document.getElementById('delete_resign').submit();
        } else {
            return false;
        }
    });


});
