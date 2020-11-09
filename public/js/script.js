(function($) {
    showSwal = function(type) {
    'use strict';
    if (type === 'success-pass-change') {
    swal({
    title: '성공!',
    text: '비밀번호가 변경되었습니다',
    type: 'success',
    button: {
    text: "Continue",
    value: true,
    visible: true,
    className: "btn btn-primary"
    }
    })
    
    }else if(type === 'success-profile-update'){
        swal({
            title: '성공!',
            text: '회원 정보 수정 성공!',
            type: 'success',
            button: {
            text: "Continue",
            value: true,
            visible: true,
            className: "btn btn-primary"
            }
            })
            
    }
    else{
    swal("Error occured !");
    }
    }
    
    })(jQuery);
    
