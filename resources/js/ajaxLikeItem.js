$(function() {
    var like = $(".js-like-toggle");
    var likeItemId;

    like.on("click", function () {
        var $this = $(this);
        likeItemId = $this.data("itemid");
        var items = document.getElementsByClassName("item_" + likeItemId);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/item/ajaxlike", //routeの記述
            type: "POST", //受け取り方法の記述（GETもある）
            data: {
                item_id: likeItemId //コントローラーに渡すパラメーター
            }
        })
            // Ajaxリクエストが成功した場合
            .done(function (data) {
                if ($this.hasClass("loved")) {
                    [].forEach.call(items, function(elem) {
                        elem.classList.remove("loved");
                    });
                } else {
                    [].forEach.call(items, function(elem) {
                        elem.classList.add("loved");
                    });
                };
                [].forEach.call(items, function(elem) {
                    elem.nextElementSibling.innerHTML = data.itemLikesCount;
                });
            })
            // Ajaxリクエストが失敗した場合
            .fail(function(data, xhr, err) {
                //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
                //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
                console.log("エラー");
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
