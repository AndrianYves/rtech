/** 
  * JS Custom
  * Created:  06/01/20
  * Updated:  10/01/20
  *
*/


(function($) {

    console.log('Running RSG Custom Script ~');
    $(window).load(function(){

        // Registration / Login / Reset password Page
        if( $('.member_login_page').length > 0 ){
            if( URLpram('do') == '' ){ 
                window.location.href = window.location+'?do=member_register';
            }
            if( URLpram('do')=='member_login' ) {
                $('.member_login_tab_item').click();
            }else if( URLpram('do')=='member_register' ){
                $('.member_register_tab_item').click();
            }else if( URLpram('do')== 'member_forgot_password'){
                $('.member_forpass_tab_item').click();
            }else{
                window.location.href = window.location+'?do=member_register';
            }
        }
    })
    $(document).ready(function() {
        
        /**
         * Registration
         */
        password.onchange = validatePassword;
	    confirm_password.onkeyup = validatePassword;
        $("input#txtConfirmPassword").keyup(isPasswordMatch);

        rsg_tablesorter();

        closemodalclick();
        
        // navigation
        $('.rsg-select .rsg-select-toggle').click(function(){
            if( $(this).hasClass('active') ){
                $(this).removeClass('active');
                $('.rsg-select .rsg-dropdown').slideUp();
            }else{
                $(this).addClass('active');
                $('.rsg-select .rsg-dropdown').slideDown();
            }
            
            
        })

        // Change status of admin
        $('.adminStatBtn').click(function(){
            t = $(this).attr('t');
            i = $(this).attr('i');
            $('.rsg-preloader').addClass('active');
            $.ajax({
                type: "POST", url: "../r.functions.php",
                data: { 'i' : i, 'rsg_action':'changeAdminStat','t':t }, cache: false,
                success:  function(d){
                    $('.rsg-preloader').removeClass('active');
                    console.log(d);
                    if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                    closemodalreload();
                },
                error: function(e){
                    $('.rsg-preloader').removeClass('active');
                    console.log(e);
                    closemodalreload();
                }
            });
        });

        // Change status of students
        $('.studentStatBtn').click(function(){
            t = $(this).attr('t');
            i = $(this).attr('i');
            $('.rsg-preloader').addClass('active');
            $.ajax({
                type: "POST", url: "../r.functions.php",
                data: { 'i' : i, 'rsg_action':'changeStudentStat','t':t }, cache: false,
                success:  function(d){
                    $('.rsg-preloader').removeClass('active');
                    console.log(d);
                    if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                    closemodalreload();
                },
                error: function(e){
                    $('.rsg-preloader').removeClass('active');
                    console.log(e);
                    closemodalreload();
                }
            });
        });

        // Change All status
        $('.AllStatBtn').click(function(){
            t = $(this).attr('t');
            $('.allstatuschange').addClass('active'); 

            $('.allstatuschange .rsgBtn.dark-blue').click(function(){
                g = $(this).attr('g');
                $('.rsg-preloader').addClass('active');
                $.ajax({
                    type: "POST", url: "../r.functions.php",
                    data: { 'g' : g, 'rsg_action':'changeAllStats','t':t }, cache: false,
                    success:  function(d){
                        $('.allstatuschange').removeClass('active'); 
                        $('.rsg-preloader').removeClass('active');
                        console.log(d);
                        if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                        closemodalreload();
                    },
                    error: function(e){
                        $('.allstatuschange').removeClass('active'); 
                        $('.rsg-preloader').removeClass('active');
                        console.log(e);
                        closemodalreload();
                    }
                });
            });
        });

        // Change All status -- Accept All Pending
        $('.AllStatBtnNoModal').click(function(){
            t = $(this).attr('t');
            g = $(this).attr('g');
            if( g=='admi' ){
                s = $('.r-adminusers input.ActionCheckBox:checkbox:checked');
            }else if( g=='stud' ){
                s = $('.r-studusers input.ActionCheckBox:checkbox:checked');
            }else if( g=='pending' ){
                s = $('.r-pendingusers input.ActionCheckBox:checkbox:checked');
            }
            var ar = [];
            if( s.length > 0 ){ s.each(function (){ ar.push($(this).val()); })
            }else{ ar = 'none'; }

            $.ajax({
                type: "POST", url: "../r.functions.php",
                data: { 'g' : g, 'rsg_action':'changeAllStats','t':t, 'ar':ar }, cache: false,
                success:  function(d){
                    $('.rsg-preloader').removeClass('active');
                    if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                    closemodalreload();
                },
                error: function(e){
                    $('.rsg-preloader').removeClass('active');
                    console.log(e);
                    closemodalreload();
                }
            });
        });

        // Archive / Delete / Hide / Show post/announcement
        $('.announcementActions').click(function(){
            i = $(this).attr('i'); t = $(this).attr('t');
            s = $('.r-announcements input.ActionCheckBox:checkbox:checked');
            var ar = [];
            if( s.length > 0 ){
                s.each(function (){ ar.push($(this).val()); })
            }else{ ar = 'none'; }
            $.ajax({
                type: "POST", url: "../r.functions.php",
                data: { 'i' : i, 'rsg_action':'announcementActions', 't':t ,'ar':ar}, cache: false,
                success:  function(d){
                    $('.rsg-preloader').removeClass('active');
                    if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                    closemodalreload();
                },
                error: function(e){
                    $('.rsg-preloader').removeClass('active');
                    console.log(e);
                    closemodalreload();
                }
            });
        })

        // Archive / Delete Polls
        $('.pollsActions').click(function(){
            i = $(this).attr('i'); t = $(this).attr('t');
            s = $('.r-pollsActions input.ActionCheckBox:checkbox:checked');
            var ar = [];
            if( s.length > 0 ){
                s.each(function (){ ar.push($(this).val()); })
            }else{ ar = 'none'; }
            $.ajax({
                type: "POST", url: "../r.functions.php",
                data: { 'i' : i, 'rsg_action':'pollsActions', 't':t,'ar':ar}, cache: false,
                success:  function(d){
                    $('.rsg-preloader').removeClass('active');
                    if( d['msg'] == '' ){ console.log('no message ~'); }else{ $('body').append(d['msg']); }
                    closemodalreload();
                },
                error: function(e){
                    $('.rsg-preloader').removeClass('active');
                    console.log(e);
                    closemodalreload();
                }
            });
        })

    }); 

    function URLpram(s){
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        var ret = '';
        for (var i = 0; i < sURLVariables.length; i++){
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == s){
                ret = sParameterName[1];
            }
        }
        return ret;
    }

    var password = $('input#txtNewPassword'), confirm_password = $('input#txtConfirmPassword');

    /**
     * Registration Password Validation
     */
	function validatePassword(){
		if(password.val() != confirm_password.val()) {
			confirm_password.setCustomValidity("Passwords Don't Match");
		} else {
			confirm_password.setCustomValidity('');
		}
	}
	function isPasswordMatch() {
		var password = $("input#txtNewPassword").val();
		var confirmPassword = $("input#txtConfirmPassword").val();

		if (password != confirmPassword) $("#divCheckPassword").html("");
		else $("#divCheckPassword").html("Passwords match.");
    }
    function rsg_tablesorter(){
        if( $('.rsg-tbl.tablesorter').length != 0  ){

            var $tbl = $('.rsg-tbl.tablesorter.rsg-tblpaged'), $pager = $('.rsg-tblpager');

            $(".rsg-tbl.tablesorter").tablesorter( { 
                sortList: [[0,1]],
                widgets: ['zebra', 'filter', 'columns']
            });

            if( $tbl.length != 0 ){
                $tbl.tablesorterPager({
                    container: $pager, 
                    cssGoto  : ".pagesize",
                    removeRows: false,
                    output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',
                    updateArrows: true,
                    savePages : false,
                    page: 0,
                    size: 10,
                    fixedHeight: true,
                    cssNext: '.next',
                    cssPrev: '.prev',
                    cssFirst: '.first',
                    cssLast: '.last',
                    cssPageDisplay: '.cssPageDisplay',
                
                })
                $.tablesorter.customPagerControls({
                    table: $tbl,
                    pager: $pager,
                    pageSize: '.rsg-tblpager .left a',
                    currentPage: '.rsg-tblpager .right a',
                    ends: 2,
                    aroundCurrent : 1,
                    link: '<a href="#">{page}</a>',
                    currentClass: 'current',
                    adjacentSpacer: '<span> | </span>',
                    distanceSpacer: '<span> &#133; <span>',
                    addKeyboard: true,
                    pageKeyStep: 10
                });
            }            
        }
        
        
    }
    function closemodalclick(){
        if( $('.rsg_popup').hasClass('closemodalreload') ){
            
            $('.closemodalreload .rsg_closePopup, .closemodalreload .rsg_BlackBG5').click(function(){ 
                $('.rsg_popup').removeClass('active');
                $('.rsg_popup input, .rsg_popup select').val('');
                window.location.href= window.location;
            } );

        }else if( $('.rsg_popup').hasClass('closemodalredirect') ){

            $('.closemodalredirect .rsg_closePopup, .closemodalredirect .rsg_BlackBG5').click(function(){ 
                $('.rsg_popup').removeClass('active');
                $('.rsg_popup input, .rsg_popup select').val('');
                window.location.href= $('.rsg_popup.closemodalredirect').attr('url');
            } );

        }else{
            $('.rsg_closePopup, .rsg_BlackBG5').click(function(){
                $('.rsg_popup').removeClass('active');
                $('.rsg_popup input, .rsg_popup select').val('');
                console.log( "All popups closed" );
            });
        }
    }

    function closemodalreload(){
        $('.rsg-preloader').removeClass('active');
        $('.rsg_closePopup, .rsg_BlackBG5').click(function(){
            $('.rsg_popup').removeClass('active');
            $('.rsg_popup input, .rsg_popup select').val('');
            location.reload(true);
        });
    }


}(jQuery));