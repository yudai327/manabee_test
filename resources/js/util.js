$('#img_del').click(function () {
    if (confirm('削除しますか？')) {
        $("#img_view").attr('src', $('#img_del').val());
        $("#file_img").attr('src', "");
        $(this).parent().prev().children('.custom-file-label').html('画像選択...');
        $("#file_img").val("");
    }
});

$('#file_img').on('change', function (e) {
    var reader = new FileReader();
    if(e.target.files[0]){
        reader.readAsDataURL(e.target.files[0]);
    }else{
        $("#img_view").attr('src', $('#img_del').val());
    }
    reader.onload = function (e) {
        $("#img_view").attr('src', e.target.result);
    }
});

$('#free_flg').click(function () {
	if ($('#free_flg').prop('checked')) {
	    $("#price").val("");
	    $("#price").prop("readonly", true);
	    $("#price").prop("placeholder", "");
	    $("#price").css("backgroundColor", "silver");
	} else {
	    $("#price").prop("readonly", false);
	    $("#price").prop("placeholder", "(例)2980");
	    $("#price").css("backgroundColor", "white");
	}
});

$('#edit_pre_del').click(function () {
    if (confirm('削除しますか？')) {
        $(this).parent().prev().children('.custom-file-label').html('動画選択...');
        $("#customEditPreFile").val("");
    }
});
$('#edit_pre_del2').click(function () {
    if (confirm('削除しますか？')) {
        $(this).parent().prev().children('.custom-file-label').html('動画...');
        $("#customEditPreFile2").val("");
    }
});

$('.custom-file-input').on('change', function () {
    if($(this)[0].files[0] && $(this)[0].files[0].name){
        $(this).next('.custom-file-label').html($(this)[0].files[0].name);
    }else{
        $(this).next('.custom-file-label').html("選択されていません。")
    }
})

$(function () {
    if ($('.text-input').val().length == 0) {
        $('#text-submit').prop('disabled', true);
    }
    $('.text-input').on('keydown keyup keypress change', function () {
        if ($(this).val().length > 0) {
            $('#text-submit').prop('disabled', false);
        } else {
            $('#text-submit').prop('disabled', true);
        }
    });
});

$(function () {
    var $textarea = $('#textarea');
    var lineHeight = parseInt($textarea.css('lineHeight'));
    $textarea.on('input', function (evt) {
        var lines = ($(this).val() + '\n').match(/\n/g).length;
        $(this).height(lineHeight * lines);
    });
    console.log($textarea)
});

$(function(){
    $('.js-autolink').each(function () {
        $(this).html($(this).html().replace(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig, "<a href='$1' class='text-primary'>$1</a>"));
    });
});
